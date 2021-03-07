<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategories extends Model
{
    use HasFactory;

    public $table = "product_categories";


    protected $fillable = [
        'slug',
        'title',
        'title_ua',
        'title_ru',
        'description',
        'description_ua',
        'description_ru',
//        'meta_keywords',
//        'meta_description',
    ];



//    public function


}
