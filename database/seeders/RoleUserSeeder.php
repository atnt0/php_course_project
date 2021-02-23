<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrayRoleUsers = [
            [
                'role' => 'admin',
                'email' => 'admin@admin.com', // Chuck Norris
            ],
            [
                'role' => 'manager',
                'email' => 'manager@manager.com', // Алексей Гайдаров
            ],
            [
                'role' => 'customer',
                'email' => 'customer1@customer1.com', // Махлин Федор
            ],
            [
                'role' => 'customer',
                'email' => 'customer2@customer2.com', // Кимачинский Борис
            ],
            [
                'role' => 'customer',
                'email' => 'customer3@customer3.ua', // Михайленко Кирилл
            ],
        ];


        if( count($arrayRoleUsers) > 0 ) {
            foreach ($arrayRoleUsers as $roleUser) {
                $userFound = DB::table('users')->where('email', '=', $roleUser['email'])->first();

                if ( $userFound ) {
                    $roleFound = DB::table('role_user')->where('user_id', '=', $userFound->id)->first();

                    if ( !$roleFound ) {
                        $user = User::where('email', '=', $roleUser['email'])->firstOrFail();
                        $role = Role::where('name', '=', $roleUser['role'])->firstOrFail();

                        //$user->assignRole($role);
                        $user->roles()->attach($role);
                    }
                }
            }
        }

    }
}
