<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductPhotos extends Model
{
    use HasFactory;

    public $table = "product_photos";

    protected $fillable = [
        'uuid',
        'product_id',
        'index',
        'file_name',
        'user_own_id',
        'description',
        'description_ua',
        'description_ru',
    ];



    /**
     * @return \Illuminate\Support\Collection
     * Получить максимальный индекс/позицию по данному продукту
     */
    public static function getMaxIndex($product_id)
    { // : array

        return DB::table('product_photos as pp')
            ->where('pp.product_id', '=', $product_id)
            ->get()
            ->max('index');
    }

    /**
     * @return \Illuminate\Support\Collection
     * Получить все фотографии с ссылками на продукты, к которым они были загружены
     */
    public static function getProductPhotos()
    {

        $complaints = DB::table('product_photos as pp')
            ->join('products as p', 'pp.product_id', '=', 'p.id')

//            ->where('ic.instruction_id', '=', $instructionId)
            ->select(
                // фотография
                'pp.id as id',
                'pp.uuid as uuid',
                'pp.product_id as product_id',
                'pp.index as index',
                'pp.file_name as file_name',
                'pp.user_own_id as user_own_id',
                'pp.description as description',
                'pp.description_ua as description_ua',
                'pp.description_ru as description_ru',
                // прикреплен к продукту
                'p.uuid as product_uuid',
                'p.title as product_title',
                'p.title_ua as product_title_ua',
                'p.title_ru as product_title_ru',
                'p.description as product_description',
                'p.description_ua as product_description_ua',
                'p.description_ru as product_description_ru',
            )
            ->get();

        return $complaints;
    }

    /**
     * @return \Illuminate\Support\Collection
     * Получить все фотографии по продукту по его id (не uuid)
     */
    public static function getProductPhotosByProductId($product_id)
    {

        $complaints = DB::table('product_photos as pp')
//            ->join('products as p', 'pp.product_id', '=', 'p.id')

            ->where('pp.product_id', '=', $product_id)
            ->select(
            // фотография
                'pp.id as id',
                'pp.uuid as uuid',
                'pp.product_id as product_id',
                'pp.index as index',
                'pp.file_name as file_name',
                'pp.user_own_id as user_own_id',
                'pp.description as description',
                'pp.description_ua as description_ua',
                'pp.description_ru as description_ru',
                // прикреплен к продукту
//                'p.uuid as product_uuid',
//                'p.title as product_title',
//                'p.title_ua as product_title_ua',
//                'p.title_ru as product_title_ru',
//                'p.description as product_description',
//                'p.description_ua as product_description_ua',
//                'p.description_ru as product_description_ru',
            )
            ->get();

        return $complaints;
    }

    /**
     * @return \Illuminate\Support\Collection
     * Получить одну главную фотографию по продукту по его id (не uuid)
     */
    public static function getProductPhotoByProductId($product_id)
    {

        $complaints = DB::table('product_photos as pp')
//            ->join('products as p', 'pp.product_id', '=', 'p.id')

            ->where('pp.product_id', '=', $product_id)
//            ->where('pp.index', '=', 0)
            ->select(
            // фотография
                'pp.id as id',
                'pp.uuid as uuid',
                'pp.product_id as product_id',
                'pp.index as index',
                'pp.file_name as file_name',
                'pp.user_own_id as user_own_id',
                'pp.description as description',
                'pp.description_ua as description_ua',
                'pp.description_ru as description_ru',
            )
            ->get();

        return $complaints;
    }

}
