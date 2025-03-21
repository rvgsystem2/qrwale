<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $guarded=['id'];

    public function reviews()  
    {
        return $this->hasMany(Review::class); // Assuming your review model is named "Review"
    }
    public function user()
{
    return $this->belongsTo(User::class);
}

}
