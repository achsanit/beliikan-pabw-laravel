<?php

namespace App\Service\Seller;

use App\Models\Category;

class CategoryService 
{
    public function index() 
    {
        return Category::all();
    }
    
    public function store($category) 
    {
        return Category::create($category);
    }

    public function deleteCategory($id)
    {
        $data = Category::find($id);
        $data->delete();

        return $data;
    }

    public function show($id)
    {
        $data = Category::find($id);

        return $data;
    }
}