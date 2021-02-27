<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrayRoles = [
            [
                'name' => 'admin', // администратор-наполнятель
                'title' => 'Admin',
                'title_ua' => 'Адмін',
                'title_ru' => 'Админ',
            ],
            [
                'name' => 'manager', //менеджер-продавец
                'title' => 'Manager',
                'title_ua' => 'Менеджер',
                'title_ru' => 'Менеджер',
            ],
            [
                'name' => 'customer', // зарегистрированный покупатель - он же пользователь
                'title' => 'Customer',
                'title_ua' => 'Клієнт',
                'title_ru' => 'Покупатель',
            ],
        ];

        if( count($arrayRoles) > 0 ) {
            foreach ($arrayRoles as $role) {
                $roleFound = DB::table('user_roles')->where('name', '=', $role['name'])->first();
                if( !$roleFound ) {
                    $admin = new Role();
                    $admin->name = $role['name'];
                    $admin->title = $role['title'];
                    $admin->title_ua = $role['title_ua'];
                    $admin->title_ru = $role['title_ru'];
                    $admin->save();
                }
            }
        }

    }
}
