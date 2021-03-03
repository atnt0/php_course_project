<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrayStatusOrders = [
            [
                'order_id' => 1,
                'status_id' => 1,
                'quantity' => 12,
            ],
        ];


        if( count($arrayStatusOrders) > 0 ) {
//            $dateTimeNow = date('YYYY-MM-DD hh:mm:ss'); // MySql format date time
            $dateTimeNow = date('Y-m-d H:i');

            foreach ($arrayStatusOrders as $statusOrder) {

                DB::table('status_order')
                    ->insert([
                        'order_id' => $statusOrder['order_id'],
                        'status_id' => $statusOrder['status_id'],
                        'quantity' => $statusOrder['quantity'],
                        'created_at' => $dateTimeNow,
                        'updated_at' => $dateTimeNow,
                    ]);
            }
        }
    }
}
