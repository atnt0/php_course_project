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
            'Admin', // администрацтор-наполнятель
            'Manager', //менеджер-продавец
            'Customer', // зарегистрированный покупатель - он же пользователь
        ];

        if( count($arrayRoles) > 0 ) {
            foreach ($arrayRoles as $role) {
                $roleFound = DB::table('user_roles')->where('title', '=', $role)->first();
                if( !$roleFound ) {
                    $admin = new Role();
                    $admin->title = $role;
                    $admin->save();
                }
            }
        }

    }
}
