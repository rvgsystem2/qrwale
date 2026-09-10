<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $guarded=['id'];

    protected $casts = [
        'rating' => 'float',
        'qr_scan_count' => 'integer',
        'social_clicks' => 'array',
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class); // Assuming your review model is named "Review"
    }
public function user()
{
    return $this->belongsTo(User::class);
}

    public function template()
    {
        return $this->belongsTo(BusinessTemplate::class, 'business_template_id');
    }

    public function getLogoUrlAttribute(): ?string
    {
        return $this->logo_img ? asset('storage/'.$this->logo_img) : null;
    }

    public function getWhatsappNumberAttribute(): string
    {
        $number = preg_replace('/\D+/', '', $this->watsapp_url ?: $this->mobile_number ?: '');
        return strlen($number) === 10 ? '91'.$number : $number;
    }




    public function products()
{
    return $this->hasMany(BusinessProduct::class)
        ->orderBy('sort_order')
        ->orderByDesc('id');
}

}
