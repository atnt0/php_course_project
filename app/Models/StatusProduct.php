<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class StatusProduct extends Model
{
    use HasFactory;

    protected $table = 'product_statuses';


    public static function createReferenceStatusWithProduct(array $statusProduct)
    {
        $dateTimeNow = date('Y-m-d H:i:s');

        $data = [
            'product_uuid' => $statusProduct['product_uuid'],
            'status_id' => $statusProduct['status_id'],
            'created_at' => $dateTimeNow,
            'updated_at' => $dateTimeNow,
        ];

        $result = DB::table('status_product')->insert($data);
    }

    /**
     * Получить все статусы продукта за все время существования продукта
     */
    public static function getAllProductStatusesByProduct($product_uuid)
    {
        return DB::table('status_product as sp')
            ->leftJoin('product_statuses as pss', 'sp.status_id', '=', 'pss.id')
            ->where('sp.product_uuid', '=', $product_uuid)
            ->orderBy('sp.created_at', 'asc') // desc
            ->get();
    }

    /**
     * Получить один последний статус продукта за все время существования продукта
     */
    public static function getLastProductStatusByProduct($product_uuid)
    {
        return DB::table('status_product as sp')
            ->join('product_statuses as pss', 'sp.status_id', '=', 'pss.id')
            ->where('sp.product_uuid', '=', $product_uuid)
            ->select(
                '*',
                'sp.created_at as sp_created_at',
                'sp.updated_at as sp_updated_at',
            )
//            ->orderBy('sp.created_at', 'desc') // desc
//            ->limit(1)
            ->get();
    }



    /**
     * получить все имеющиеся варианты статусов продукта в системе
     */
    public static function getAllProductStatuses()
    {
        return DB::table('product_statuses as pss')
            ->orderBy('pss.id', 'asc')
            ->get();
    }






}
