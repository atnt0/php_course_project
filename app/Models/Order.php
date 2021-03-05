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
        'user_own_id',

        'comment',
        'email',
        'phone',

        'client_first_name',
        'client_last_name',
        'client_patronymic_name',

        'address_city',
        'address_zip',
        'address_street',
        'address_house',
        'address_floor',
        'address_apart',
        'address_np_number',

        'guest_ip',
        'guest_useragent',
    ];



//    /**
//     * get all of the products for the order.
//     */
//    public function products()
//    {
//        return $this->morphToMany(Product::class, 'order_product');
//    }

//    public static function getProducts($order_id){
    public function getProducts(){

        return DB::table('order_product as o_p')
            ->leftjoin('products as p', 'o_p.product_id', '=', 'p.id' )
            ->where('order_id', '=', $this->id)
            ->select(
                'p.*', //todo убрать звездочку
                'o_p.quantity as op_quantity',
                'o_p.price as op_price',
                'o_p.tax as op_tax',
            )
            ->get();
    }


}
