<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $products = Product::latest('id')->get();
        $nostock = Product::where('stock', '<=', '3')->get();

        // dd($nostock);
        return view('admin.product', compact('products', 'nostock'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::all();

        if (auth()->user()->is_admin == 1){
            return view('admin.addProduct', compact('categories'));
        }
        
        return redirect('home')->with('noAuthorized', 'tidak memiliki otorisasi, anda bukan admin.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'name' => 'required|max:255|string',
            'category_id' => 'integer|required',
            'price' => 'integer|required',
            'stock' => 'integer|required',
            'img_url' => 'image|file|max:3072',
            'description' => 'required|string'
        ]);

        if($request->file('img_url')){
            $validatedData['img_url'] = $request->file('img_url')->store('img-product');
        }

        Product::create($validatedData);

        return redirect('/admin/addproduct')->with('success', 'Produk Baru Sudah Ditambahkan...');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $categories = Category::all();
        $product = Product::where('id', $id)->first();
        // dd($product);

        return view("admin.updateProduct", compact("categories", "product"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $validatedData = $request->validate([
            'name' => 'required|max:255|string',
            'category_id' => 'integer|required',
            'price' => 'integer|required',
            'stock' => 'integer|required',
            'img_url' => 'image|file|max:3072',
            'description' => 'required|string'
        ]);

        if($request->file('img_url')){
            $validatedData['img_url'] = $request->file('img_url')->store('img-product');
        }

        $product = Product::where('id', $id)->first();

        $product->update($validatedData);

        return redirect('/admin/addproduct')->with('update', 'Produk Sudah Diupdate...');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $product = Product::find($id);
        $product->delete();
        return redirect()->back()->with('hapus', 'Product '.$product->name. ' dihapus dari data barang');
    }
}
