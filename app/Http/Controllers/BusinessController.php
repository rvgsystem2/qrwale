<?php

namespace App\Http\Controllers;

use App\Http\Requests\BusinessRequest;
use App\Mail\AdminReviewNotification;
use App\Mail\BusinessReviewNotification;
use App\Mail\ThankYouMail;
use App\Models\Business;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class BusinessController extends Controller implements HasMiddleware
{

    public static function middleware()
    {
        return [
            new Middleware('permission:view business', only:['index']),
            new Middleware('permission:edit business', only:['edit']),
            new Middleware('permission:delete business', only:['delete']),
            new Middleware('permission:create business', only:['create']),
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

        // If rating is 2 or 5, redirect to review_url
        // if ($request->rating == 2 || $request->rating == 5) {
        //     return redirect()->to($business->review_url);
        // }

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



    public function showQRPage($identifier)
    {
        $business = Business::where('custum_url', $identifier)
            ->orWhere('id', $identifier)
            ->firstOrFail();
        // Increment scan count
        $business->increment('qr_scan_count');
        return view('business.qr_page', compact('business'));
    }







    public function trackSocialClick(Request $request, $id)
{
    $business = Business::findOrFail($id);
    $platform = $request->platform; // Get platform name (fb_url, insta_url, etc.)

    // Get existing click data
    $clicks = $business->social_clicks ? json_decode($business->social_clicks, true) : [];

    // Increment the count for the selected platform
    $clicks[$platform] = isset($clicks[$platform]) ? $clicks[$platform] + 1 : 1;

    // Update the database
    $business->update(['social_clicks' => json_encode($clicks)]);

    return response()->json(['success' => true, 'clicks' => $clicks]);
}



    public function index() {
        if (auth()->user()->hasRole('Super Admin')) {
            $businesses = Business::all(); // Show all businesses for Super Admin
        } else {
            $businesses = Business::where('user_id', auth()->id())->get(); // Show only the user's businesses
        }

        return view('business.index', compact('businesses'));
    }



    public function create() {
        if (auth()->user()->hasRole('Super Admin')) {
            $users = User::all(); // Super Admin sees all users
        } else {
            $users = User::where('id', auth()->id())->get(); // Normal users only see themselves
        }
        return view('business.create', compact('users'));
    }

    public function edit(Business $business) {
        if (auth()->user()->hasRole('Super Admin')) {
            $users = User::all(); // Super Admin sees all users
        } else {
            $users = User::where('id', auth()->id())->get(); // Normal users only see themselves
        }
        return view('business.create', compact('business', 'users'));
    }




    public function store(BusinessRequest $request) {
        $data = $request->validated();

        // Assign user (selected user or logged-in user)
        $data['user_id'] = $request->user_id ?? auth()->id();

        // Handle Logo Upload
        if ($request->hasFile('logo_img')) {
            $data['logo_img'] = $request->file('logo_img')->store('logos', 'public');
        }

        Business::create($data);

        return redirect()->route('business.index')->with('success', 'Business created successfully.');
    }

    public function update(BusinessRequest $request, Business $business) {
        if (!Auth::user()->hasRole('Super Admin') && $business->user_id !== Auth::id()) {
            return redirect()->route('business.index')->with('error', 'Unauthorized action.');
        }

        $data = $request->validated();


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
        $businesses = Business::all();
    } else {
        $businesses = Business::where('user_id', auth()->id())->get();
    }

    $totalBusinesses = $businesses->count();

    $totalScans = $businesses->sum('qr_scan_count');

    // Sum all social clicks
    $totalSocialClicks = 0;
    foreach ($businesses as $business) {
        $clicks = json_decode($business->social_clicks, true);
        if (is_array($clicks)) {
            $totalSocialClicks += array_sum($clicks);
        }
    }

    return view('dashboard', compact('totalBusinesses', 'totalScans', 'totalSocialClicks','businesses'));
}

}
