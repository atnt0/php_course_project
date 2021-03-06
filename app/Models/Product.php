<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;

    public $table = "products";


    protected $fillable = [
        'uuid',
        'article_number', // sku?
        'price',
        'quantity',
        'category_id',
        'user_own_id',
        'slug',
        'title',
        'title_ua',
        'title_ru',
        'description',
        'description_ua',
        'description_ru',
        'meta_keywords',
        'meta_description',
    ];


    /**
     * @return \Illuminate\Support\Collection
     * Получить продукты в почти готовом, полусобранном виде
     */
    public static function getProducts()  { // : array

        return DB::table('products as p')
            //->join('product_photos as ph', 'p.id', '=', 'ph.product_id') // array
            ->leftJoin('product_categories as c', 'p.category_id', '=', 'c.id')

            ->leftJoin('status_product as sp', 'p.uuid', '=', 'sp.product_uuid') // связующая
            ->leftJoin('product_statuses as pss', 'sp.status_id', '=', 'pss.id')

            ->select(
                // продукт
                'p.uuid as uuid',
                'p.article_number as article_number',
                'p.price as price',
                'p.quantity as quantity',
                'p.category_id as category_id',
                'p.user_own_id as user_own_id',
                'p.title as title',
                'p.title_ua as title_ua',
                'p.title_ru as title_ru',
                'p.description as description',
                'p.description_ua as description_ua',
                'p.description_ru as description_ru',
                'p.meta_keywords as meta_keywords',
                'p.meta_description as meta_description',
                'p.created_at as created_at',
                'p.updated_at as updated_at',
                // категория продукта
                'c.title as category_title',
                'c.title_ua as category_title_ua',
                'c.title_ru as category_title_ru',
                'c.description as category_description',
                'c.description_ua as category_description_ua',
                'c.description_ru as category_description_ru',
                // Статус продукта
                'pss.name as product_status_name',
                'pss.title as product_status_title',
                'pss.title_ua as product_status_title_ua',
                'pss.title_ru as product_status_title_ru',
                'sp.created_at as product_status_created_at',
                'sp.updated_at as product_status_updated_at',

            )
            //->pluck('id') // ->toArray();
            ->get();
    }


    /**
     * @return \Illuminate\Support\Collection
     * Получить один продукт в почти готовом, полусобранном виде по его uuid
     */
    public static function getProduct($uuid)  { // : array
        return DB::table('products as p')
            ->leftJoin('product_categories as c', 'p.category_id', '=', 'c.id')
            ->leftJoin('status_product as sp', 'p.uuid', '=', 'sp.product_uuid') // связующая
            ->leftJoin('product_statuses as pss', 'sp.status_id', '=', 'pss.id')
            ->where('p.uuid', '=', $uuid)
            ->select([
                // продукт
                'p.uuid as uuid',
                'p.article_number as article_number',
                'p.price as price',
                'p.quantity as quantity',
                'p.category_id as category_id',
                'p.user_own_id as user_own_id',
                'p.title as title',
                'p.title_ua as title_ua',
                'p.title_ru as title_ru',
                'p.description as description',
                'p.description_ua as description_ua',
                'p.description_ru as description_ru',
                'p.meta_keywords as meta_keywords',
                'p.meta_description as meta_description',
                'p.created_at as created_at',
                'p.updated_at as updated_at',
                // категория продукта
                'c.title as category_title',
                'c.title_ua as category_title_ua',
                'c.title_ru as category_title_ru',
                'c.description as category_description',
                'c.description_ua as category_description_ua',
                'c.description_ru as category_description_ru',
                // Статус продукта
                'pss.name as product_status_name',
                'pss.title as product_status_title',
                'pss.title_ua as product_status_title_ua',
                'pss.title_ru as product_status_title_ru',
                'sp.created_at as product_status_created_at',
                'sp.updated_at as product_status_updated_at',

            ])
            //->pluck('id') //->toArray();
            ->get()
            ->first();
    }



}
