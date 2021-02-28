<?php

namespace Database\Seeders;

use App\Models\ProductCategories;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrayCategories = [
            [
                'id' => 1,
                'parent_id' => 0,
                'title' => '',
                'title_ua' => '',
                'title_ru' => 'Моя категория',
                'description' => '',
                'description_ua' => '',
                'description_ru' => 'Описание моей категории',
            ],
            [
                'id' => 2,
                'parent_id' => 1,
                'title' => '',
                'title_ua' => '',
                'title_ru' => 'Моя вторая категория',
                'description' => '',
                'description_ua' => '',
                'description_ru' => 'Описание второй категории',
            ],
        ];

        if( count($arrayCategories) > 0 ){
            foreach ($arrayCategories as $category) {
                $categoryFound = DB::table('product_categories')
                    ->where('id', '=', $category['id'])->first();

                if( !$categoryFound ) {
                    $categoryNew = new ProductCategories();

                    $categoryNew['id'] = $category['id'];

                    if( $category['parent_id'] != null && $category['parent_id'] > 0 )
                        $categoryNew['parent_id'] = $category['parent_id'];

                    $categoryNew['title'] = $category['title'];
                    $categoryNew['title_ua'] = $category['title_ua'];
                    $categoryNew['title_ru'] = $category['title_ru'];
                    $categoryNew['description'] = $category['description'];
                    $categoryNew['description_ua'] = $category['description_ua'];
                    $categoryNew['description_ru'] = $category['description_ru'];

                    $categoryNew->save();
                }
            }
        }



    }
}
