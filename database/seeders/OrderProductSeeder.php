<?php

namespace Database\Seeders;

use App\Models\Order;
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
                'order_uuid' => '78c9db80-b18d-4aae-8355-dd301224a39f',
                'product_uuid' => '2e9e14e3-9ccc-4cda-bee6-bfa7aedb2d23',
                'price' => 12110000,
                'quantity' => 18,
            ],
        ];

        // for order_product

        if( count($arrayOrderProducts) > 0 ) {
            foreach ($arrayOrderProducts as $orderProduct) {
                Order::createReferenceOrderWithProduct($orderProduct);
            }
        }
    }
}
