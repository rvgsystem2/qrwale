<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BusinessRequest;
use App\Models\Business;
use Illuminate\Support\Facades\Storage;

class BusinessApprovalController extends Controller
{
     public function index(){
        $requests = BusinessRequest::latest()->get();
        return view('admin.business_requests',compact('requests'));
    }



    public function destroy(BusinessRequest $requestRow)
{
    // ✅ logo delete from storage
    if (!empty($requestRow->logo_img)) {
        Storage::disk('public')->delete($requestRow->logo_img);
    }

    $requestRow->delete();

    return back()->with('success', 'Request deleted successfully.');
}
    public function approve(BusinessRequest $requestRow){

        Business::create($requestRow->only([
            'bussiness_name','mobile_number','website_url','fb_url',
            'insta_url','linkden_url','watsapp_url','twiter_url',
            'review_url','address','rating','logo_img','custum_url'
        ]));

        $requestRow->update([
            'status'=>'approved',
            'approved_by'=>auth()->id(),
            'approved_at'=>now()
        ]);

        return back()->with('success','Business Approved');
    }

    public function reject(BusinessRequest $requestRow)
{
    // already approved ya rejected ho to dubara change na ho
    if ($requestRow->status !== 'pending') {
        return back()->with('error', 'This request is already processed.');
    }

    $requestRow->update([
        'status'      => 'rejected',
        'approved_by'=> auth()->id(),
        'approved_at'=> now(),
    ]);

    return back()->with('success', 'Business request rejected successfully.');
}

}
