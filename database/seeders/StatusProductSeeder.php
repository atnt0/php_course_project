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
            ['status_id' => 1, 'product_uuid' => 'fcce115b-4dd8-4a8f-82eb-3269be968b2a',],
            ['status_id' => 3, 'product_uuid' => '57e72b99-19fe-49f3-8c78-aa65a5297541',],
            ['status_id' => 4, 'product_uuid' => 'ba4e0e20-7c29-11eb-bfe1-31f78429e044',],
            ['status_id' => 2, 'product_uuid' => '2e9e14e3-9ccc-4cda-bee6-bfa7aedb2d23',],
        ];

        if( count($arrayStatusProducts) > 0 ) {
            foreach ($arrayStatusProducts as $statusProduct) {
                StatusProduct::createReferenceStatusWithProduct($statusProduct);
            }
        }

    }
}
