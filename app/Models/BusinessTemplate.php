<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BusinessTemplate extends Model
{
    protected $guarded = ['id'];
    protected $casts = ['is_active' => 'boolean', 'is_default' => 'boolean'];
    public function businesses(): HasMany
    {
        return $this->hasMany(Business::class);
    }
}
