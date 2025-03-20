<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    //

    protected $fillable = ['business_id', 'name', 'email', 'rating', 'review'];

    // Define the relationship with Business
    public function business() {
        return $this->belongsTo(Business::class);
    }
}
