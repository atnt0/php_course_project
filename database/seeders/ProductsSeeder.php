<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Webpatser\Uuid\Uuid;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrayProducts = [
            [
                'id' => 1,
                'article_number' => '6549225',
                'price' => 78200, // 78.20 грн - умножение на 10 тысяч
                'tax' => 0, // 0.0 грн - умножение на 10 тысяч
                'quantity' => 20,
                'category_id' => 1,
                'user_own_id' => 1,
                'uuid' => 'fcce115b-4dd8-4a8f-82eb-3269be968b2a', //
                'title' => '',
                'title_ua' => '',
                'title_ru' => 'Продукт номер один',
                'description' => '',
                'description_ua' => '',
                'description_ru' => 'Описание продукта номер один, довольно коротко и много воды, но тем не менее описание.',
                'meta_keywords' => 'продукт номер один, №1, product number one, very good product',
                'meta_description' => 'Такое же пустое описание но уже для роботов поисковиков.',
            ],
        ];

        if( count($arrayProducts) > 0 ){
            foreach ($arrayProducts as $product) {
                $productFound = DB::table('products')
                    ->where('id', '=', $product['id'])->first();

                if( !$productFound ) {
                    $productNew = new Product();
                    $productNew['id'] = $product['id'];
                    $productNew['article_number'] = $product['article_number'];
                    $productNew['price'] = $product['price'];
                    $productNew['tax'] = $product['tax'];
                    $productNew['quantity'] = $product['quantity'];
                    $productNew['category_id'] = $product['category_id'];
                    $productNew['user_own_id'] = $product['user_own_id'];
                    $productNew['uuid'] = $product['uuid']; // \Webpatser\Uuid\Uuid::generate()->string
                    $productNew['title'] = $product['title'];
                    $productNew['title_ua'] = $product['title_ua'];
                    $productNew['title_ru'] = $product['title_ru'];
                    $productNew['description'] = $product['description'];
                    $productNew['description_ua'] = $product['description_ua'];
                    $productNew['description_ru'] = $product['description_ru'];
                    $productNew['meta_keywords'] = $product['meta_keywords'];
                    $productNew['meta_description'] = $product['meta_description'];

                    $productNew->save();
                }
            }
        }
    }
}
