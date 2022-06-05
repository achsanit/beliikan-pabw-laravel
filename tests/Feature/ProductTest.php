<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_list_product()
    {
        Category::factory(4)->create();
        Product::factory(18)->create();

        $this->json('GET', 'api/products')->assertStatus(200);
    }

    public function test_create_product()
    {
        $file = UploadedFile::fake()->image('avatar.png');

        $category = Category::factory()->create();

        $seller = [
            'name' => 'sellerTest',
            'phone' => '081258900173',
            'address' => 'address test',
            'email' => 'sellerTest@gmail.com',
            'password' => 'applee',
            'province_id' => '15',
            'city_id' => '19'
        ];

        $newProduct = [
            'category_id' => $category->id,
            'name' => 'product test',
            'price' => 20000,
            'description' => 'ini product test',
            'stock' => 4,
            'img_url' => $file,
        ];

        $this->json('POST', 'api/seller/register',$seller)
            ->assertStatus(200);

        $credential = [
            'email' => 'sellerTest@gmail.com',
            'password' => 'applee'
        ];

        $userLogin = $this->call('POST', '/api/seller/login', $credential)->getContent();

        $token ='Bearer '.json_decode($userLogin)->data->access_token;

        $headers = [
            'Authorization' => $token
        ];

        $this->json('POST', 'api/seller/products', $newProduct, $headers)
            ->assertStatus(200)
            ->assertJsonStructure([
                'code',
                'status',
                'data' => [],
            ]);
    }

    public function test_get_product()
    {
        Category::factory(4)->create();
        $newProduct = Product::factory()->create();

        $this->json('GET', 'api/products/'.$newProduct->id)
            ->assertStatus(200)
            ->assertJson([
               'status' =>'susccess get product',
            ]);
    }

    public function test_delete_product()
    {
        $newProduct = Product::factory()->create();

        $seller = [
            'name' => 'sellerTest',
            'phone' => '081258900173',
            'address' => 'address test',
            'email' => 'sellerTest@gmail.com',
            'password' => 'applee',
            'province_id' => '15',
            'city_id' => '19'
        ];

        $this->json('POST', 'api/seller/register',$seller)
            ->assertStatus(200);

        $credential = [
            'email' => 'sellerTest@gmail.com',
            'password' => 'applee'
        ];

        $userLogin = $this->call('POST', '/api/seller/login', $credential)->getContent();

        $token ='Bearer '.json_decode($userLogin)->data->access_token;

        $headers = [
            'Authorization' => $token
        ];

        $this->json('DELETE', 'api/seller/products/'.$newProduct->id,[],$headers)
            ->assertStatus(200)
            ->assertJson([
                'status' => 'delete data successfully'
            ]);
    }
}
