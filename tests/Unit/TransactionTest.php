<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Tests\TestCase;

class TransactionTest extends TestCase
{
    public function test_example()
    {
        User::factory(5)->create();

        Product::factory(18)->create();

        Category::factory(4)->create();

        $response = [
            'user_id' => 1,
            'address' => 'testing address',
            'no_telp' => 'testing no telp',
            'product_id' => 1,
            'qty' => 2,
        ];

        $this->json('POST', route('transaction.post'), $response)->assertStatus(200);
    }
}
