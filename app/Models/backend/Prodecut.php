<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Prodecut extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['nameEn','nameAr','descriptionEn','descriptionAr',
    'is_available','quantity','colorEn',
    'colorAr','image','categoryId','price'];
}
