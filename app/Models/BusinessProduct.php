<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessProduct extends Model
{
    protected $fillable = [
        'business_id',
        'name',
        'image',
        'price',
        'offer_price',
        'description',
        'button_text',
        'button_url',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'offer_price' => 'decimal:2',
        'sort_order' => 'integer',
        'is_active' => 'boolean',
    ];

    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function getImageUrlAttribute(): string
    {
        return asset('storage/' . $this->image);
    }
}
