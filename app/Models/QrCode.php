<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QrCode extends Model
{
    protected $fillable = ['user_id', 'url'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
