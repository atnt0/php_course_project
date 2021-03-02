<?php

namespace Database\Seeders;

use App\Models\ProductPhotos;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductPhotosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrayPhotos = [
            [
                'uuid' => '6551f34b-a5d5-493a-b08d-80e75c6d67ba',
                'product_id' => 1,
                'index' => 2,
                'file_name' => '021fd0e0-79e3-11eb-ac7d-558a28babdf5.jpg',
                'user_own_id' => 1,
                'description' => '',
                'description_ua' => '',
                'description_ru' => 'Первое фото',
            ],
            [
                'uuid' => '917b3182-a3a0-4808-a688-3a54fa72f3fa',
                'product_id' => 1,
                'index' => 1,
                'file_name' => 'd448feaf-501c-4ab3-981e-46af0d30d6b2.jpg',
                'user_own_id' => 1,
                'description' => '',
                'description_ua' => '',
                'description_ru' => 'Второе фото',
            ],
            [
                'uuid' => '76a8dcfe-1ac9-4ac6-94d7-ae092ae28605',
                'product_id' => 2,
                'index' => 0,
                'file_name' => '846c1959-60ab-4904-bfa0-d45f56db7422.png',
                'user_own_id' => 1,
                'description' => '',
                'description_ua' => '',
                'description_ru' => 'Третье фото',
            ],
            [
                'uuid' => '3ec4f9d0-7b5c-11eb-9a7a-b7fc6b971d60',
                'product_id' => 1,
                'index' => 3,
                'file_name' => '3ec39140-7b5c-11eb-b1f5-291d9fa77200.png',
                'user_own_id' => 1,
                'description' => '',
                'description_ua' => '',
                'description_ru' => '',
            ],
            [
                'uuid' => '55a58760-7b5e-11eb-9076-1393fbe99e36',
                'product_id' => 1,
                'index' => 4,
                'file_name' => '55a40360-7b5e-11eb-9f76-252ccd7e5bb6.png',
                'user_own_id' => 1,
                'description' => '',
                'description_ua' => '',
                'description_ru' => '',
            ],
            [
                'uuid' => 'f77a0ff0-7b5e-11eb-900f-25ec687d64e6',
                'product_id' => 1,
                'index' => 0,
                'file_name' => 'f7786370-7b5e-11eb-a76f-637b5bbf5176.png',
                'user_own_id' => 1,
                'description' => '',
                'description_ua' => '',
                'description_ru' => '',
            ],
            [
                'uuid' => 'ab2d9640-7b5f-11eb-8826-2db63c9e0bfe',
                'product_id' => 2,
                'index' => 1,
                'file_name' => 'ab2bb180-7b5f-11eb-a7d3-07687798c302.png',
                'user_own_id' => 1,
                'description' => '',
                'description_ua' => '',
                'description_ru' => '',
            ],
            [
                'uuid' => 'ee734440-7b5f-11eb-ba0b-1de7026cea20',
                'product_id' => 2,
                'index' => 0,
                'file_name' => 'ee719ff0-7b5f-11eb-bece-ab2f0013f1de.jpg',
                'user_own_id' => 1,
                'description' => '',
                'description_ua' => '',
                'description_ru' => '',
            ],
        ];

        if( count($arrayPhotos) > 0 ) {
            foreach ($arrayPhotos as $photo) {
                $photoFound = DB::table('product_photos')
                    ->where('uuid', '=', $photo['uuid'])->first();

                if( !$photoFound ) {
                    $photoNew = new ProductPhotos();

                    $photoNew['uuid'] = $photo['uuid'];
                    $photoNew['product_id'] = $photo['product_id'];
                    $photoNew['index'] = $photo['index'];
                    $photoNew['file_name'] = $photo['file_name'];
                    $photoNew['user_own_id'] = $photo['user_own_id'];
                    $photoNew['description'] = $photo['description'];
                    $photoNew['description_ua'] = $photo['description_ua'];
                    $photoNew['description_ru'] = $photo['description_ru'];

                    $photoNew->save();
                }
            }
        }

    }
}
