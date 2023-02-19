<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Modules\Stores\Entities\Store;
use Spatie\Permission\Models\Role;
use Modules\Products\Entities\Product;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {


        Role::create(['name' => 'admin']);
        Role::create(['name' => 'user']);

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
        ]);

        $admin->assignRole('admin');



        User::factory(10)->create()
            ->each(function ($user) {
                $user->assignRole('user');
            });

        Store::factory(10)->create();

        Product::factory(10)->create();
    }
}
