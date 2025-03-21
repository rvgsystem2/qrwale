<?php

namespace App\Http\Controllers;

use App\Http\Requests\BusinessRequest;
use App\Models\Business;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
            'email' => 'required|email',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string',
        ]);
    
        // If rating is 2 or 5, redirect to review_url
        if ($request->rating == 2 || $request->rating == 5) {
            return redirect()->to($business->review_url);
        }
    
        // Save review in database
        Review::create([
            'business_id' => $id,
            'name' => $request->name,
            'email' => $request->email,
            'rating' => $request->rating,
            'review' => $request->review,
        ]);
    
        return redirect()->route('business.qr', $id)->with('success', 'Review submitted successfully!');
    }

    // public function showQRPage($id)
    // {
    //     $business = Business::findOrFail($id);
    //     return view('business.qr_page', compact('business'));
    // // }
    // public function showQRPage($identifier)
    // {
    //     $business = Business::where('custum_url', $identifier)
    //         ->orWhere('id', $identifier)
    //         ->firstOrFail();
    
    //     return view('business.qr_page', compact('business'));
    // }

    public function showQRPage($identifier)
    {
        $business = Business::where('custum_url', $identifier)
            ->orWhere('id', $identifier)
            ->firstOrFail();
    
        return view('business.qr_page', compact('business'));
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
        $users = User::all(); // Fetch all users
        return view('business.create', compact('users'));
    }
    
    public function edit(Business $business) {
        $users = User::all();
        return view('business.create', compact('business', 'users'));
    }
    


    // public function store(BusinessRequest $request) {
    //     $data = $request->validated();
    
    //     // Assign the business to the logged-in user
    //     $data['user_id'] = Auth::id();
    
    //     // Handle Logo Upload
    //     if ($request->hasFile('logo_img')) {
    //         $data['logo_img'] = $request->file('logo_img')->store('logos', 'public');
    //     }
    
    //     Business::create($data);
    
    //     return redirect()->route('business.index')->with('success', 'Business created successfully.');
    // }
    



    // public function store(BusinessRequest $request) {
    //     $data = $request->validated();
    
    //     // If user is selected, assign the selected user; otherwise, assign the logged-in user
    //     $data['user_id'] = $request->user_id ?? auth()->id();
    
    //     if ($request->hasFile('logo_img')) {
    //         $data['logo_img'] = $request->file('logo_img')->store('logos', 'public');
    //     }
    
    //     Business::create($data);
    
    //     return redirect()->route('business.index')->with('success', 'Business created successfully.');
    // }
    

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
    



    // public function update(BusinessRequest $request, Business $business) {
    //     // Ensure users can only update their own businesses
    //     if (!Auth::user()->hasRole('Super Admin') && $business->user_id !== Auth::id()) {
    //         return redirect()->route('business.index')->with('error', 'Unauthorized action.');
    //     }
    
    //     $data = $request->validated();
    
    //     // Handle Logo Update
    //     if ($request->hasFile('logo_img')) {
    //         if ($business->logo_img) {
    //             Storage::disk('public')->delete($business->logo_img);
    //         }
    //         $data['logo_img'] = $request->file('logo_img')->store('logos', 'public');
    //     }
    
    //     $business->update($data);
    
    //     return redirect()->route('business.index')->with('success', 'Business updated successfully.');
    // }
    
    
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
    
}
