<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Services\BusinessQrService;

class BusinessQrController extends Controller
{
    public function image(Business $business, BusinessQrService $service)
    {
        return response($service->svg($business), 200, ['Content-Type'=>'image/svg+xml','Cache-Control'=>'public, max-age=3600']);
    }
    public function download(Business $business, BusinessQrService $service)
    {
        return response($service->svg($business), 200, ['Content-Type'=>'image/svg+xml','Content-Disposition'=>'attachment; filename="'.($business->custum_url ?: 'business-'.$business->id).'-qr.svg"']);
    }
}
