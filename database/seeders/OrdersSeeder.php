<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrayOrders = [
            [
                'id' => 1,
                'user_own_id' => 1,
                'comment' => 'Очень нужно, отправьте быстрее, пожалуйста!',
                'email' => 'adrean@fake.com',
                'phone' => '+380501234567',
                'address_city' => 'Углегорск',
                'address_zip' => '86481',
                'address_street' => 'ул. Горняка',
                'address_house' => '15',
                'address_floor' => '',
                'address_apart' => '63',
                'address_np_number' => '',
                'guest_ip' => '127.0.0.1',
                'guest_useragent' => 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/5360 (KHTML, like Gecko) Chrome/39.0.889.0 Mobile Safari/5360',
            ],
        ];

        if( count($arrayOrders) > 0 ) {
            foreach ($arrayOrders as $order) {
                $orderFound = DB::table('products')
                    ->where('id', '=', $order['id'])->first();

                if( !$orderFound ) {
                    $orderNew = new Order();

                    $orderNew['id'] = $order['id'];
                    $orderNew['id'] = $order['id'];
                    $orderNew['id'] = $order['id'];
                }
            }
        }



    }
}
