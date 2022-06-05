<?php

namespace App\Service;

use App\Models\Product;

class ProductService
{
    public function index()
    {
        return Product::with('Category')->latest('id');
    }

    public function show($id)
    {
        $data = Product::where('id', $id)->with('Category')->first();
        return $data;
    }
    
}
