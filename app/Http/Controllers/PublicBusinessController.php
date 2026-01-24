<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BusinessRequest;
class PublicBusinessController extends Controller
{
    public function create() {
        return view('public.business');
    }

   public function store(Request $request)
{
    $data = $request->validate([
        'name'            => 'nullable|string|max:100',
        'phone'           => 'nullable|string|max:20',
        'email'           => 'nullable|email|max:150',

        'custum_url'     => 'nullable|string|max:255',
        'bussiness_name' => 'required|string|max:255',
        'mobile_number'  => 'nullable|string|max:20',
        'website_url'    => 'nullable|url|max:255',
        'fb_url'         => 'nullable|url|max:255',
        'insta_url'      => 'nullable|url|max:255',
        'linkden_url'    => 'nullable|url|max:255',
        'watsapp_url'    => 'nullable|string|max:20',
        'twiter_url'     => 'nullable|url|max:255',
        'review_url'     => 'nullable|url|max:255',
        'address'        => 'nullable|string',
        'rating'         => 'nullable|numeric|min:0|max:5',
        'logo_img'       => 'nullable|image|max:2048',
    ]);

    if ($request->hasFile('logo_img')) {
        $data['logo_img'] = $request->file('logo_img')->store('logos', 'public');
    }

    BusinessRequest::create($data);
return redirect()->route('business.thanks');
    // return back()->with('success', 'आपकी जानकारी सफलतापूर्वक भेज दी गई है। एडमिन अप्रूवल के बाद बिज़नेस एक्टिव होगा।');
}

}
