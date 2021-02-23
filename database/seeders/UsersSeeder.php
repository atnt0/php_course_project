<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $arrayUsers = [
            [
                'name' => 'Chuck Norris',
                'email' => 'admin@admin.com',
                'password' => 'forever',
            ],
            [
                'name' => 'Алексей Гайдаров',
                'email' => 'manager@manager.com',
                'password' => 'team-number-one!',
            ],
            [
                'name' => 'Махлин Федор',
                'email' => 'customer1@customer1.com',
                'password' => 'team-number-two!',
            ],
            [
                'name' => 'Кимачинский Борис',
                'email' => 'customer2@customer2.com',
                'password' => 'team-number-two!',
            ],
            [
                'name' => 'Михайленко Кирилл',
                'email' => 'customer3@customer3.ua',
                'password' => 'team-number-two!',
            ],
        ];

        if( count($arrayUsers) > 0 ){
            foreach ($arrayUsers as $user) {
                $userFound = DB::table('users')->where('email', '=', $user['email'])->first();
                if( !$userFound ) {
                    $admin = new User();
                    $admin->name = $user['name'];
                    $admin->email = $user['email'];
                    $admin->password = bcrypt($user['password']);
                    $admin->save();
                }
            }
        }

    }
}
