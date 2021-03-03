<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrayOrderProducts = [
            [
                'product_id' => 7,
                'order_id' => 1,
                'quantity' => 12,
            ],
        ];

        // for product_order

        if( count($arrayOrderProducts) > 0 ) {
//            $dateTimeNow = date('YYYY-MM-DD hh:mm:ss'); // MySql format date time
            $dateTimeNow = date('Y-m-d H:i');

            foreach ($arrayOrderProducts as $orderProduct) {
                //TODO заменить на работу с моделью или репозиторием
                DB::table('product_order')
                    ->insert([
                        'order_id' => $orderProduct['order_id'],
                        'product_id' => $orderProduct['product_id'],
                        'quantity' => $orderProduct['quantity'],
//                        'created_at' => $dateTimeNow,
//                        'updated_at' => $dateTimeNow,
                    ]);
            }
        }
    }
}
