<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class category extends Model
{
    use HasFactory;
    use SoftDeletes;
    //  protected $table = 'categories';
    protected $fillable = ['nameEn','nameAr','discriptionEn','discriptionAr','image','parent'];
}
