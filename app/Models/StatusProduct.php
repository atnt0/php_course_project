<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class StatusProduct extends Model
{
    use HasFactory;

    protected $table = 'product_statuses';

    //TODO стоит изменить название на множественное число, чтобы не путаться со связывающей таблицей + у StatusOrder

    /**
     * @param $product_id
     * @param $status_id
     * @return bool
     * Метод создает запись связывающую продукт со статусом, тем самым меняя статус продукта
     */
    public static function createManyToManyWithStatus(int $product_id, int $status_id) : bool {
//      $dateTimeNow = date('YYYY-MM-DD hh:mm:ss'); // MySql format date time
        $dateTimeNow = date('Y-m-d H:i');

        return DB::table('status_product')
            ->insert([
                'product_id' => $product_id,
                'status_id' => $status_id,
                'created_at' => $dateTimeNow,
                'updated_at' => $dateTimeNow,
            ]);
    }
}
