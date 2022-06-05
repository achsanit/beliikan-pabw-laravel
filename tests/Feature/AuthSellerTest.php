<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Seller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthSellerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_login_true()
    {
        $seller = Seller::create([
            'name' => 'seller test',
            'address' => 'address test',
            'phone' => '081258900173',
            'province_id' => '15',
            'city_id' => '19'
        ]);

        User::create([
            'email' => 'sellerTest@gmail.com',
            'password' => Hash::make('applee'),
            'userable_id' => $seller->id,
            'userable_type' => 'seller'
        ]);

        $credential = [
            'email' => 'sellerTest@gmail.com',
            'password' => 'applee'
        ];

        $this->json('POST', '/api/seller/login', $credential)
            ->assertStatus(200);
    }

    public function test_login_return_false()
    {
        $seller = Seller::create([
            'name' => 'seller test',
            'address' => 'address test',
            'phone' => '081258900173',
            'province_id' => '15',
            'city_id' => '19'
        ]);

        User::create([
            'email' => 'sellerTest@gmail.com',
            'password' => Hash::make('applee'),
            'userable_id' => $seller->id,
            'userable_type' => 'seller'
        ]);

        $credential = [
            'email' => 'seller@gmail.com',
            'password' => 'applee'
        ];

        $this->json('POST', '/api/seller/login', $credential)
            ->assertStatus(401)
            ->assertJson([
                "error" => "Unauthorized"
            ]);
    }
    
    public function test_register_true()
    {
        $seller = [
            'name' => 'sellerTest',
            'phone' => '081258900173',
            'address' => 'address test',
            'email' => 'sellerTest@gmail.com',
            'password' => 'applee',
            'province_id' => '15',
            'city_id' => '19'
        ];

        $credential = [
            'email' => 'sellerTest@gmail.com',
            'password' => 'applee'
        ];

        $this->json('POST', 'api/seller/register',$seller)
            ->assertStatus(200);

        $this->json('POST', 'api/seller/login', $credential)
            ->assertStatus(200);
    }

}
