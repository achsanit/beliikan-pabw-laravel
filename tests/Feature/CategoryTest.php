<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_category()
    {
        Category::factory(4)->create();

        $this->json('GET', 'api/category/1')
            ->assertStatus(200);
    }

    public function test_list_category()
    {
        Category::factory(4)->create();

        $this->json('GET', 'api/category')
            ->assertStatus(200)
            ->assertJsonStructure([
                'code',
                'status',
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'image_url',
                        'created_at',
                        'updated_at'
                    ]
                ]
            ]);
    }

    public function test_create_category()
    {
        $file = UploadedFile::fake()->image('avatar.png');

        $newCategory = [
            'name' => 'ikan',
            'img_url' => $file
        ];

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

        $userLogin = $this->call('POST', '/api/seller/login', $credential)->getContent();
        
        $token ='Bearer '.json_decode($userLogin)->data->access_token;

        $headers = [
            'Authorization' => $token
        ];

        $this->json('POST', 'api/seller/category', $newCategory,$headers)->assertStatus(200);
    }

    public function test_delete_category()
    {
        $newCategory = Category::factory()->create();

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

        $userLogin = $this->call('POST', '/api/seller/login', $credential)->getContent();
        
        $token ='Bearer '.json_decode($userLogin)->data->access_token;

        $headers = [
            'Authorization' => $token
        ];

        $this->json('DELETE', 'api/seller/category/'.$newCategory->id, [], $headers)
            ->assertStatus(200)
            ->assertJsonStructure([
                'code',
                'status',
                'data'
            ]);
    }
}
