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

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'uuid';
    }



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

        return DB::table('order_product as o_p')
            ->leftjoin('products as p', 'o_p.product_uuid', '=', 'p.uuid' )
            ->where('order_uuid', '=', $this->uuid)
            ->select(
                'p.*', //todo убрать звездочку
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
