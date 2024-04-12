<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class testimomial extends Model
{
    use HasFactory;

    protected $fillable = [
        'testimonialAr',
        'testimonialEn',
        'userID',
    ];
}
