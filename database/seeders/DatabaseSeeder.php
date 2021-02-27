<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(UsersSeeder::class);
        $this->call(UserRolesSeeder::class);
        $this->call(RoleUserSeeder::class);

        $this->call(ProductStatusesSeeder::class);
        $this->call(ProductsSeeder::class);
        $this->call(StatusProductSeeder::class);

        $this->call(OrderStatusesSeeder::class);
        $this->call(OrdersSeeder::class);



    }
}
