<?php

namespace Database\Seeders;

use App\Models\StatusOrder;
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
            ['status_id' => 1, 'order_uuid' => '78c9db80-b18d-4aae-8355-dd301224a39f',],
        ];


        if( count($arrayStatusOrders) > 0 ) {
            foreach ($arrayStatusOrders as $statusOrder) {
                StatusOrder::createReferenceStatusWithOrder($statusOrder);
            }
        }
    }
}
