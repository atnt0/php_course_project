<?php

namespace Database\Seeders;

use App\Models\StatusProduct;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrayStatuses = [
            [
                'name' => 'availabletoall',
                'title' => 'Available to all',
                'title_ua' => 'Доступно всім',
                'title_ru' => 'Доступно всем',
            ],
            [
                'name' => 'hiddencompletely',
                'title' => 'Hidden completely',
                'title_ua' => 'Приховано повністю',
                'title_ru' => 'Скрыто полностью', // даже в поиске для всех кроме админа
            ],
            [
                'name' => 'hidden',
                'title' => 'Hidden',
                'title_ua' => 'Приховано',
                'title_ru' => 'Скрыто', // но виден в поиске
            ],
            [
                'name' => 'notsupplied',
                'title' => 'Not supplied',
                'title_ua' => 'Не поставляється',
                'title_ru' => 'Не поставляется',
            ],
            [
                'name' => 'notsupplied',
                'title' => 'Out of stock',
                'title_ua' => 'Немає в наявності',
                'title_ru' => 'Нет в наличии', // закончился, Распродано
            ],
        ];

        if( count($arrayStatuses) > 0 ){
            foreach ($arrayStatuses as $status) {
                $statusFound = DB::table('product_statuses')
                    ->where('name', '=', $status['name'])->first();

                if( !$statusFound ) {
                    $newStatus = new StatusProduct();
                    //$newStatus->id = $status['id'];
                    $newStatus->name = $status['name'];
                    $newStatus->title = $status['title'];
                    $newStatus->title_ua = $status['title_ua'];
                    $newStatus->title_ru = $status['title_ru'];

                    $newStatus->save();
                }
            }
        }
    }
}