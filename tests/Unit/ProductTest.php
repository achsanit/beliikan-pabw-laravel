<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Product;
use Tests\TestCase;

class ProductTest extends TestCase
{
    public function test_example()
    {
        Product::factory(18)->create();
        Category::factory(4)->create();

        $response = $this->getJson(route('products.get'));
        $response->assertStatus(200);
    }
}
