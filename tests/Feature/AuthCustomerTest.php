<?php

namespace Tests\Feature;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthCustomerTest extends TestCase
{
    use WithFaker;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_login_true()
    {
        $customer = Customer::create([
            'name' => 'customerTest',
            'address' => 'address test',
            'phone' => '081258900173',
        ]);

        User::create([
            'email' => 'customerTest@gmail.com',
            'password' => Hash::make('applee'),
            'userable_id' => $customer->id,
            'userable_type' => 'customer'
        ]);

        $credential = [
            'email' => 'customerTest@gmail.com',
            'password' => 'applee'
        ];

        $this->json('POST', '/api/login', $credential)
            ->assertStatus(200);
    }

    public function test_login_return_false()
    {
        $customer = Customer::create([
            'name' => 'customerTest',
            'address' => 'address test',
            'phone' => '081258900173',
        ]);

        User::create([
            'email' => 'customerTest@gmail.com',
            'password' => Hash::make('applee'),
            'userable_id' => $customer->id,
            'userable_type' => 'customer'
        ]);

        $credential = [
            'email' => 'customer@gmail.com',
            'password' => 'applee'
        ];

        $this->json('POST', '/api/login', $credential)
            ->assertStatus(401)
            ->assertJson([
                "error" => "Unauthorized"
            ]);
    }
    
    public function test_register_true()
    {
        $customer = [
            'name' => 'customerTest',
            'phone' => '081258900173',
            'address' => 'address test',
            'email' => 'customerTest@gmail.com',
            'password' => 'applee'
        ];

        $credential = [
            'email' => 'customerTest@gmail.com',
            'password' => 'applee'
        ];

        $this->json('POST', 'api/register',$customer)
            ->assertStatus(201);

        $this->json('POST', '/api/login', $credential)
            ->assertStatus(200);
    }

    public function test_logout_true()
    {
        $customer = [
            'name' => 'customerTest',
            'phone' => '081258900173',
            'address' => 'address test',
            'email' => 'customerTest@gmail.com',
            'password' => 'applee'
        ];

        $credential = [
            'email' => 'customerTest@gmail.com',
            'password' => 'applee'
        ];

        $this->json('POST', 'api/register',$customer);
        $userLogin = $this->call('POST', '/api/login', $credential)->getContent();
        $data = [
          'token' =>  json_decode($userLogin)->data->access_token
        ];

        $this->json('POST', 'api/logout', $data)->assertStatus(200)->getContent();
    }
}
