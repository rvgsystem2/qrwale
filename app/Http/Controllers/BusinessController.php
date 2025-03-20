<?php

namespace App\Http\Controllers;

use App\Http\Requests\BusinessRequest;
use App\Models\Business;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BusinessController extends Controller
{

    public function showQRPage($id)
    {
        $business = Business::findOrFail($id);
        return view('business.qr_page', compact('business'));
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

    public function index() {
        $businesses = Business::all();
        return view('business.index', compact('businesses'));
    }



    public function create(){
        return view('business.create');
    }


    public function store(BusinessRequest $request) {
        $data = $request->validated();
    
        // Handle Logo Upload
        if ($request->hasFile('logo_img')) {
            $data['logo_img'] = $request->file('logo_img')->store('logos', 'public');
        }
    
        Business::create($data);
    
        return redirect()->route('business.index')->with('success', 'Business created successfully.');
    }



    public function edit(Business $business) {
        return view('business.create', compact('business'));
    }



    public function update(BusinessRequest $request, Business $business) {
        $data = $request->validated();
    
        // Handle Logo Update
        if ($request->hasFile('logo_img')) {
            // Delete old image if exists
            if ($business->logo_img) {
                Storage::disk('public')->delete($business->logo_img);
            }
            $data['logo_img'] = $request->file('logo_img')->store('logos', 'public');
        }
    
        $business->update($data);
    
        return redirect()->route('business.index')->with('success', 'Business updated successfully.');
    }
    
    
}
