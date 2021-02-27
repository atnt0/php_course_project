<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\StatusProduct;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrayStatusProducts = [
            [
                'product_id' => 1,
                'status_id' => 1,
            ],
        ];

        if( count($arrayStatusProducts) > 0 ) {
//            $dateTimeNow = date('YYYY-MM-DD hh:mm:ss'); // MySql format date time
            $dateTimeNow = date('Y-m-d H:i');

            foreach ($arrayStatusProducts as $statusProduct) {


//                $productFound = DB::table('products as p')
//                    ->where('p.id', '=', $statusProduct['product_id'])->first();
//
//                if( $productFound )
//                {
//                    $statusProductFound = DB::table('status_product as sp')
//                        ->where('sp.status_id', '=', $statusProduct['status_id'])->first();

//                    if( !$statusProductFound )
//                    {
                        //$statusProductDisplay = StatusProduct::where('id', '=', $statusProduct['status_id'])->first();

                        DB::table('status_product')
                            ->insert([
                                'product_id' => $statusProduct['product_id'],
                                'status_id' => $statusProduct['status_id'],
                                'created_at' => $dateTimeNow,
                                'updated_at' => $dateTimeNow,
                            ]);
//                    }
//                }
            }
        }

    }
}
