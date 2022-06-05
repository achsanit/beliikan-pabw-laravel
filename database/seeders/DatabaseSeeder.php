<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(5)->create();


        // User::create([
        //     'name' => 'admin',
        //     'email' => 'admin@masukaja.com',
        //     'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password ,
        //     'is_admin' => 1,
        // ]);

        $firstSeller = Seller::create([
            'name' => 'seller1',
            'phone'=> '081258900173',
            'address' => 'jl. pahlawan bukit biru',
            'province_id' => 15,
            'city_id' => 215
        ]);

        $secondSeller = Seller::create([
            'name' => 'seller2',
            'phone'=> '081258900175',
            'address' => 'jl. giri rejo',
            'province_id' => 15,
            'city_id' => 19
        ]);

        $firstUser = User::create([
            'email' => 'seller1@gmail.com',
            'password' => Hash::make('applee'),
            'userable_id' => $firstSeller->id,
            'userable_type' => 'seller'
        ]);

        $secondUser = User::create([
            'email' => 'seller2@gmail.com',
            'password' => Hash::make('applee'),
            'userable_id' => $secondSeller->id,
            'userable_type' => 'seller'
        ]);

        Category::factory(4)->create();

        Product::factory(18)->create();

    }
}
