<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class StatusOrder extends Model
{
    use HasFactory;

    protected $table = 'order_statuses';





    public static function createReferenceStatusWithOrder(array $statusOrder)
    {
        $dateTimeNow = date('Y-m-d H:i');

        DB::table('status_order')
            ->insert([
                'order_uuid' => $statusOrder['order_uuid'],
                'status_id' => $statusOrder['status_id'],
                'created_at' => $dateTimeNow,
                'updated_at' => $dateTimeNow,
            ]);
    }
}
