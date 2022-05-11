<?php

namespace App\Service;

use App\Models\Product;

class ProductService
{
    public function index()
    {
        $data = Product::with('Category')->latest('id')->paginate(12);
        return $data;
    }

    public function show()
    {
        
    }
    
}
