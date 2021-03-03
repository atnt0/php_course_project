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
                'uuid' => '78c9db80-b18d-4aae-8355-dd301224a39f',

                'client_first_name' => 'Адреан',
                'client_last_name' => 'Мельников',
                'client_patronymic_name' => 'Осипович',

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
                $orderFound = DB::table('orders')
                    ->where('id', '=', $order['id'])->first();

                if( !$orderFound ) {
                    $orderNew = new Order();

                    $orderNew['id'] = $order['id'];
                    $orderNew['user_own_id'] = $order['user_own_id'];
                    $orderNew['uuid'] = $order['uuid'];
                    $orderNew['client_first_name'] = $order['client_first_name'];
                    $orderNew['client_last_name'] = $order['client_last_name'];
                    $orderNew['client_patronymic_name'] = $order['client_patronymic_name'];
                    $orderNew['comment'] = $order['comment'];
                    $orderNew['email'] = $order['email'];
                    $orderNew['phone'] = $order['phone'];
                    $orderNew['address_city'] = $order['address_city'];
                    $orderNew['address_zip'] = $order['address_zip'];
                    $orderNew['address_street'] = $order['address_street'];
                    $orderNew['address_house'] = $order['address_house'];
                    $orderNew['address_floor'] = $order['address_floor'];
                    $orderNew['address_apart'] = $order['address_apart'];
                    $orderNew['address_np_number'] = $order['address_np_number'];
                    $orderNew['guest_ip'] = $order['guest_ip'];
                    $orderNew['guest_useragent'] = $order['guest_useragent'];

                    $orderNew->save();
                }
            }
        }



    }
}
