<?php

namespace App\Service\Seller;

use App\Models\Product;

class ProductService 
{
    public function addProduct($product) 
    {
        return Product::create($product);
    }

    public function updateProduct($id, $updateProduct)
    {
        $product = Product::where('id', $id)->first(); 

        return $product->update($updateProduct);
    }

    public function deleteProduct($id)
    {
        $deleteProduct = Product::find($id);

        if ($deleteProduct != null) {
            # code...
            if ($deleteProduct->seller_id == auth()->user()->userable_id) {
                # code...
                $deleteProduct->delete();
                return $deleteProduct;
            } else {
                # code...
                $data = ['error' => 'not ur product'];
                return $data;
            }
        } else {
            # code...
            return null;
        }
        
    
    }
}