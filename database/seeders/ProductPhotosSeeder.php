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
                'description_ru' => 'Первое фото',
            ],
            [
                'uuid' => '917b3182-a3a0-4808-a688-3a54fa72f3fa',
                'product_id' => 1,
                'index' => 1,
                'file_name' => 'd448feaf-501c-4ab3-981e-46af0d30d6b2.jpg',
                'user_own_id' => 1,
                'description_ru' => 'Второе фото',
            ],
            [
                'uuid' => '76a8dcfe-1ac9-4ac6-94d7-ae092ae28605',
                'product_id' => 2,
                'index' => 0,
                'file_name' => '846c1959-60ab-4904-bfa0-d45f56db7422.png',
                'user_own_id' => 1,
                'description_ru' => 'Третье фото',
            ],
            [
                'uuid' => '3ec4f9d0-7b5c-11eb-9a7a-b7fc6b971d60',
                'product_id' => 1,
                'index' => 3,
                'file_name' => '3ec39140-7b5c-11eb-b1f5-291d9fa77200.png',
                'user_own_id' => 1,
            ],
            [
                'uuid' => '55a58760-7b5e-11eb-9076-1393fbe99e36',
                'product_id' => 1,
                'index' => 4,
                'file_name' => '55a40360-7b5e-11eb-9f76-252ccd7e5bb6.png',
                'user_own_id' => 1,
            ],
            [
                'uuid' => 'f77a0ff0-7b5e-11eb-900f-25ec687d64e6',
                'product_id' => 1,
                'index' => 0,
                'file_name' => 'f7786370-7b5e-11eb-a76f-637b5bbf5176.png',
                'user_own_id' => 1,
            ],
            [
                'uuid' => 'ab2d9640-7b5f-11eb-8826-2db63c9e0bfe',
                'product_id' => 2,
                'index' => 1,
                'file_name' => 'ab2bb180-7b5f-11eb-a7d3-07687798c302.png',
                'user_own_id' => 1,
            ],
            [
                'uuid' => 'ee734440-7b5f-11eb-ba0b-1de7026cea20',
                'product_id' => 2,
                'index' => 0,
                'file_name' => 'ee719ff0-7b5f-11eb-bece-ab2f0013f1de.jpg',
                'user_own_id' => 1,
            ],
            [
                'uuid' => '199ec440-7c1d-11eb-a8d4-e9c3a2604271',
                'product_id' => 5,
                'index' => 0,
                'file_name' => '199ad5a0-7c1d-11eb-bd98-834818a6c7ef.png',
                'user_own_id' => 1,
            ],
            [
                'uuid' => '1e318fb0-7c1d-11eb-8e75-e5ca5e3a5bcb',
                'product_id' => 5,
                'index' => 1,
                'file_name' => '1e2e7b90-7c1d-11eb-8e99-8550c9cfcab7.png',
                'user_own_id' => 1,
            ],
            [
                'uuid' => '2b6b8700-7c1d-11eb-b4d9-1507814fd2fc',
                'product_id' => 5,
                'index' => 2,
                'file_name' => '2b689060-7c1d-11eb-ba7a-296c3f456e4a.jpg',
                'user_own_id' => 1,
            ],
            [
                'uuid' => 'fb7f7c70-7c22-11eb-a47c-67a978a61793',
                'product_id' => 6,
                'index' => 1,
                'file_name' => 'fb7c7460-7c22-11eb-a86f-334ba59c6bdf.jpg',
                'user_own_id' => 1,
            ],
            [
                'uuid' => 'ffbb9120-7c22-11eb-8490-ad7b31a365e4',
                'product_id' => 6,
                'index' => 2,
                'file_name' => 'ffb88ba0-7c22-11eb-9b8c-4117282f1de6.jpg',
                'user_own_id' => 1,
            ],
            [
                'uuid' => '2bef6cdc-24d9-4131-b842-8b6df265080a',
                'product_id' => 7,
                'index' => 0,
                'file_name' => 'bfb2b5c0-7c29-11eb-9f38-75e2560f0fb6.jpg',
                'user_own_id' => 1,
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

                    $photoNew['description'] = !empty($photo['description']) ? $photo['description'] : '';
                    $photoNew['description_ua'] = !empty($photo['description_ua']) ? $photo['description_ua'] : '';
                    $photoNew['description_ru'] = !empty($photo['description_ru']) ? $photo['description_ru'] : '';

                    // // так пустота вызывает ошибку мол, не может быть null, хотя при чем здесь null не ясно
//                    $photoNew['description'] = !empty($photo['description']) ? $photo['description'] : '';

//                    if( !empty($photo['description']) )
//                        $photoNew['description_ua'] = $photo['description'];
//                    if( !empty($photo['description_ua']) )
//                        $photoNew['description_ua'] = $photo['description_ua'];
//                    if( !empty($photo['description_ru']) )
//                        $photoNew['description_ru'] = $photo['description_ru'];

                    $photoNew->save();
                }
            }
        }

    }
}
