<?php

namespace App\Http\Controllers;

use App\Http\Requests\BusinessRequest;
use App\Mail\AdminReviewNotification;
use App\Mail\BusinessReviewNotification;
use App\Mail\ThankYouMail;
use App\Models\Business;
use App\Models\BusinessTemplate;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class BusinessController extends Controller implements HasMiddleware
{

    public static function middleware()
    {
        return [
            new Middleware('permission:view business', only:['index']),
            new Middleware('permission:edit business', only:['edit','update']),
            new Middleware('permission:delete business', only:['delete']),
            new Middleware('permission:create business', only:['create','store']),
        ];
    }



    public function showRating($id)
{
    $business = Business::with('reviews')->findOrFail($id);
    return view('business.rating', compact('business'));
}

    public function submitReview(Request $request, $id)
    {
        $business = Business::findOrFail($id);

        // Validate input
        $request->validate([
            'name' => 'required|string|max:255',
            'number' => 'required|digits:10', // Ensure it's exactly 10 digits
            'email' => 'required|email',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string',
        ]);



        // Save review in database
        $review = Review::create([
            'business_id' => $id,
            'name' => $request->name,
            'number' => $request->number,
            'email' => $request->email,
            'rating' => $request->rating,
            'review' => $request->review,
        ]);

        Mail::to($review->email)->send(new ThankYouMail($review));


         // ✅ Send email to Business User
        if ($business->user && $business->user->email) {
            Mail::to($business->user->email)->send(new BusinessReviewNotification($review, $business));
        }

        if($business->email){
            Mail::to($business->email)->send(new BusinessReviewNotification($review, $business));
        }

        // Send Notification email to Super Admin
        Mail::to('realvictorygroups@gmail.com')->send(new AdminReviewNotification($review, $business));
        return redirect()->back()->with('success', 'Review submitted successfully!');

        // return redirect()->route('business.qr', $id)->with('success', 'Review submitted successfully!');
    }



    public function showQRPageOld($identifier)
    {
        $business = Business::where('custum_url', $identifier)
            ->orWhere('id', $identifier)
            ->firstOrFail();
        // Increment scan count
        $business->increment('qr_scan_count');
        $business->loadMissing('template');
        if (!$business->template || !$business->template->is_active) {
            $business->setRelation('template', BusinessTemplate::where('is_default', true)->first() ?? BusinessTemplate::where('is_active', true)->first());
        }
        return view('business.qr_page', compact('business'));
    }




    public function showQRPage($identifier)
{
    $business = Business::query()
        ->with([
            'template',

            'products' => function ($query) {
                $query->where('is_active', true)
                    ->orderBy('sort_order')
                    ->orderByDesc('id');
            },
        ])
        ->where(function ($query) use ($identifier) {
            $query->where(
                'custum_url',
                $identifier
            );

            if (ctype_digit((string) $identifier)) {
                $query->orWhere(
                    'id',
                    (int) $identifier
                );
            }
        })
        ->firstOrFail();

    $business->increment('qr_scan_count');

    if (
        !$business->template ||
        !$business->template->is_active
    ) {
        $defaultTemplate = BusinessTemplate::query()
            ->where('is_active', true)
            ->orderByDesc('is_default')
            ->first();

        $business->setRelation(
            'template',
            $defaultTemplate
        );
    }

    $viewName = 'business.qr_page';

    if (filled($business->template?->view_key)) {
        $configuredView = config(
            'business_templates.views.'
                . $business->template->view_key
                . '.view'
        );

        if (
            $configuredView &&
            view()->exists($configuredView)
        ) {
            $viewName = $configuredView;
        }
    }

    return view(
        $viewName,
        compact('business')
    );
}




    public function trackSocialClick(Request $request, $id)
{
    $business = Business::findOrFail($id);
    $platform = $request->validate(['platform'=>['required',Rule::in(['call','whatsapp','website','google','facebook','instagram','linkedin','twitter','youtube','review'])]])['platform'];
    $clicks = $business->social_clicks ?? [];

    // Increment the count for the selected platform
    $clicks[$platform] = isset($clicks[$platform]) ? $clicks[$platform] + 1 : 1;

    // Update the database
    $business->update(['social_clicks' => $clicks]);

    return response()->json(['success' => true, 'clicks' => $clicks]);
}



    public function index() {
        if (auth()->user()->hasRole('Super Admin')) {
            $businesses = Business::with(['user','template'])->latest()->get();
        } else {
            $businesses = Business::with(['user','template'])->where('user_id', auth()->id())->latest()->get();
        }

        return view('business.index', compact('businesses'));
    }



    public function create() {
        if (auth()->user()->hasRole('Super Admin')) {
            $users = User::all(); // Super Admin sees all users
        } else {
            $users = User::where('id', auth()->id())->get(); // Normal users only see themselves
        }
        $templates = BusinessTemplate::where('is_active', true)->orderByDesc('is_default')->orderBy('name')->get();
        return view('business.create', compact('users','templates'));
    }

    public function edit(Business $business)
{
    if (
        !auth()->user()->hasRole('Super Admin') &&
        (int) $business->user_id !== (int) auth()->id()
    ) {
        abort(403, 'Unauthorized action.');
    }

    if (auth()->user()->hasRole('Super Admin')) {
        $users = User::orderBy('name')->get();
    } else {
        $users = User::where('id', auth()->id())->get();
    }

    $templates = BusinessTemplate::query()
        ->where(function ($query) use ($business) {
            $query->where('is_active', true);

            // Inactive selected template bhi edit ke samay visible rahega
            if ($business->business_template_id) {
                $query->orWhere(
                    'id',
                    $business->business_template_id
                );
            }
        })
        ->orderByDesc('is_default')
        ->orderBy('name')
        ->get();

    return view('business.create', compact(
        'business',
        'users',
        'templates'
    ));
}




    public function store(BusinessRequest $request) {
        $data = $request->validated();

        // Assign user (selected user or logged-in user)
        $data['user_id'] = auth()->user()->hasRole('Super Admin') ? ($request->user_id ?? auth()->id()) : auth()->id();

        // Handle Logo Upload
        if ($request->hasFile('logo_img')) {
            $data['logo_img'] = $request->file('logo_img')->store('logos', 'public');
        }

        $business = Business::create($data);
        return redirect()->route('business.index')->with('success', 'Business created and logo QR generated successfully.');
    }

    public function update(BusinessRequest $request, Business $business) {
        if (!Auth::user()->hasRole('Super Admin') && $business->user_id !== Auth::id()) {
            return redirect()->route('business.index')->with('error', 'Unauthorized action.');
        }

        $data = $request->validated();
        if (!Auth::user()->hasRole('Super Admin')) $data['user_id'] = Auth::id();


        // Handle Logo Update
        if ($request->hasFile('logo_img')) {
            if ($business->logo_img) {
                Storage::disk('public')->delete($business->logo_img);
            }
            $data['logo_img'] = $request->file('logo_img')->store('logos', 'public');
        }

        $business->update($data);

        return redirect()->route('business.index')->with('success', 'Business updated successfully.');
    }







    public function delete(Business $business) {
        // Allow Super Admin to delete any business, but regular users can only delete their own
        if (!Auth::user()->hasRole('Super Admin') && $business->user_id !== Auth::id()) {
            return redirect()->route('business.index')->with('error', 'Unauthorized action.');
        }

        // Delete logo if exists
        if ($business->logo_img) {
            Storage::disk('public')->delete($business->logo_img);
        }

        $business->delete();

        return redirect()->route('business.index')->with('success', 'Business deleted successfully.');
    }


    public function dashboard()
{
    if (auth()->user()->hasRole('Super Admin')) {
        $businesses = Business::with('template')->get();
    } else {
        $businesses = Business::with('template')->where('user_id', auth()->id())->get();
    }

    $totalBusinesses = $businesses->count();

    $totalScans = $businesses->sum('qr_scan_count');

    // Sum all social clicks
    $totalSocialClicks = 0;
    foreach ($businesses as $business) {
        $clicks = $business->social_clicks;
        if (is_array($clicks)) {
            $totalSocialClicks += array_sum($clicks);
        }
    }

    return view('dashboard', compact('totalBusinesses', 'totalScans', 'totalSocialClicks','businesses'));
}

}
