<?php

namespace Database\Seeders;

use App\Models\StatusOrder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderStatuses extends Seeder
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
                'name' => 'acceptedforprocessing',
                'title' => 'Accepted for processing',
                'title_ua' => 'Прийняте в обробку',
                'title_ru' => 'Принят в обработку',
            ],
            [
                'name' => 'sent',
                'title' => 'Sent',
                'title_ua' => 'Відправлено',
                'title_ru' => 'Отправлено',
            ],
            [
                'name' => 'performed',
                'title' => 'Performed',
                'title_ua' => 'Виконано',
                'title_ru' => 'Выполнено',
            ],
            [
                'name' => 'canceledbybuyer',
                'title' => 'Canceled by buyer',
                'title_ua' => 'Скасовано покупцем',
                'title_ru' => 'Отменено покупателем',
            ],
            [
                'name' => 'canceledrequestofbuyer',
                'title' => 'Canceled at the request of the buyer',
                'title_ua' => 'Скасовано на прохання покупця',
                'title_ru' => 'Отменено по просьбе покупателя',
            ],
            [
                'name' => 'canceledbystoreadmin',
                'title' => 'Canceled by the store administration',
                'title_ua' => 'Скасовано адміністрацією магазину',
                'title_ru' => 'Отменено администрацией магазина',
            ],
        ];


        if( count($arrayStatuses) > 0 ){
            foreach ($arrayStatuses as $status) {
                $statusFound = DB::table('product_statuses')
                    ->where('name', '=', $status['name'])->first();

                if( !$statusFound ) {
                    $newStatus = new StatusOrder();
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
