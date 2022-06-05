<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

// class TransactionTest extends TestCase
// {
//     /**
//      * A basic feature test example.
//      *
//      * @return void
//      */
//     public function test_create_transaction()
//     {
//         $file = UploadedFile::fake()->image('avatar.png');

//         $category = Category::factory()->create();

//         $seller = [
//             'name' => 'sellerTest',
//             'phone' => '081258900173',
//             'address' => 'address test',
//             'email' => 'sellerTest@gmail.com',
//             'password' => 'applee',
//             'province_id' => '15',
//             'city_id' => '19'
//         ];

//         $newProduct = [
//             'category_id' => $category->id,
//             'name' => 'product test',
//             'price' => 20000,
//             'description' => 'ini product test',
//             'stock' => 4,
//             'img_url' => $file,
//         ];

//         $this->json('POST', 'api/seller/register',$seller)
//             ->assertStatus(200);

//         $credential = [
//             'email' => 'sellerTest@gmail.com',
//             'password' => 'applee'
//         ];

//         $userLogin = $this->call('POST', '/api/seller/login', $credential)->getContent();

//         $token ='Bearer '.json_decode($userLogin)->data->access_token;

//         $headers = [
//             'Authorization' => $token
//         ];

//         $product = $this->json('POST', 'api/seller/products', $newProduct, $headers)->getContent();

//         $customer = [
//             'name' => 'customer test',
//             'phone' => '081258900173',
//             'address' => 'address test',
//             'email' => 'customerTest@gmail.com',
//             'password' => 'applee',
//         ];

//         $this->json('POST','api/register',$customer);

//         $customerCredential = [
//             'email' => 'customerTest@gmail.com',
//             'password' => 'applee'
//         ];

//         $custLogin = $this->json('POST', 'api/login', $customerCredential)->getContent();

//         $custHeaders = [
//             'Authorization' => 'Bearer '.json_decode($custLogin)->data->access_token
//         ];

//         $userId = json_decode($custLogin)->data->user->id;

//         $transaction = [
//             'address' => 'jl giri rejo',
//             'no_telp'=> '081259800173',
//             'product_id' => json_decode($product)->data->id,
//             'qty' => 2,
//             'user_id' => $userId,
//             'province_id' => 18,
//             'city_id' => 21,
//             'service_shipping' => 0,
//             'courier' => 'jne'
//         ];

//         $this->json('POST', 'api/transaction', $transaction, $custHeaders)
//             ->assertStatus(200)
//             ->assertJsonStructure([
//                 'code',
//                 'status',
//                 'data' => [
//                     'transaction',
//                     'detail'
//                 ]
//             ]);
//     }
// }
