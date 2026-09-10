<?php

namespace App\Services;

use App\Models\Business;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class BusinessQrService
{
    public function svg(Business $business, int $size = 900): string
    {
        $svg = QrCode::format('svg')->size($size)->margin(2)->errorCorrection('H')
            ->generate(route('business.qr', $business->custum_url ?: $business->id));
        if (!$business->logo_img || !Storage::disk('public')->exists($business->logo_img)) return $svg;
        $path = Storage::disk('public')->path($business->logo_img);
        $logo = 'data:'.(mime_content_type($path) ?: 'image/png').';base64,'.base64_encode(file_get_contents($path));
        $logoSize = (int) ($size * .18); $padding = (int) ($size * .02);
        $pos = (int) (($size - $logoSize) / 2); $boxPos = $pos - $padding; $boxSize = $logoSize + 2 * $padding;
        $overlay = '<rect x="'.$boxPos.'" y="'.$boxPos.'" width="'.$boxSize.'" height="'.$boxSize.'" rx="'.$padding.'" fill="#fff"/><image href="'.$logo.'" x="'.$pos.'" y="'.$pos.'" width="'.$logoSize.'" height="'.$logoSize.'" preserveAspectRatio="xMidYMid meet"/>';
        return str_replace('</svg>', $overlay.'</svg>', $svg);
    }
}

