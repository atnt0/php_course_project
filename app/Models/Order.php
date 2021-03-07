<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory, Notifiable;

    public $table = "orders";

    protected $fillable = [
        'uuid',

        'user_own_id',

        'address_city',
        'address_zip',
        'address_street',
        'address_house',
        'address_entrance',
        'address_floor',
        'address_apart',

        'address_np_number',

        'client_first_name',
        'client_last_name',
        'client_patronymic_name',

        'client_phone',
        'client_email',
        'comment',

        'guest_ip',
        'guest_useragent',
    ];

    public $incrementing = false;
    protected $primaryKey = 'uuid';

//    /**
//     * Get the route key for the model.
//     *
//     * @return string
//     */
//    public function getRouteKeyName()
//    {
//        return 'uuid';
//    }



//    /**
//     * get all of the products for the order.
//     */
//    public function products()
//    {
//        return $this->morphToMany(Product::class, 'order_product');
//    }

//    public static function getProducts($order_id){
    public function getProducts()
    {
        //todo лучше вызвать из Product
        return DB::table('order_product as o_p')
            ->leftjoin('products as p', 'o_p.product_uuid', '=', 'p.uuid' )
            ->where('order_uuid', '=', $this->uuid)
            ->select(
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
                // значения из связи
                'o_p.quantity as op_quantity',
                'o_p.price as op_price',
            )
            ->get();
    }


    public static function createReferenceOrderWithProduct(array $orderProduct)
    {
//            $dateTimeNow = date('YYYY-MM-DD hh:mm:ss'); // MySql format date time
        $dateTimeNow = date('Y-m-d H:i');

        //TODO заменить на работу с моделью или репозиторием
        DB::table('order_product')
            ->insert([
                'order_uuid' => $orderProduct['order_uuid'],
                'product_uuid' => $orderProduct['product_uuid'],

                'price' => $orderProduct['price'],
                'quantity' => $orderProduct['quantity'],

                'created_at' => $dateTimeNow,
                'updated_at' => $dateTimeNow,
            ]);

    }






}
