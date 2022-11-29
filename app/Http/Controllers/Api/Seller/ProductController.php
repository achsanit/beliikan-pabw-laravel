<?php

namespace App\Http\Controllers\Api\Seller;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Service\Seller\ProductService;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,ProductService $serviceProduct)
    {
        //
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:255|string',
            'category_id' => 'integer|required',
            'price' => 'integer|required',
            'stock' => 'integer|required',
            'img_url' => 'image|file|max:3072',
            'description' => 'required|string'
        ]);
        Validator::make($request->all(),[
            'name' => 'string|required|max:366'
        ]);

        if ($validator->fails()) {
            # code...
            $message = $validator->getMessageBag();
            return ResponseFormatter::error(null, $message);
        }

        if($request->file('img_url')){
            $img_url = $request->file('img_url')->store('img-product');
        }

        $newProduct = [
            'name' => $request->name,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'stock' => $request->stock,
            'img_url' => $img_url,
            'description' => $request->description,
            'seller_id' => auth()->user()->userable_id
        ];
        $data = $serviceProduct->addProduct($newProduct);

        return ResponseFormatter::success($data,"create new product successfully..");

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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, ProductService $serviceProduct)
    {
        //
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:255|string',
            'category_id' => 'integer|required',
            'price' => 'integer|required',
            'stock' => 'integer|required',
            'img_url' => 'image|file|max:3072',
            'description' => 'required|string'
        ]);

        if ($validator->fails()) {
            # code...
            $message = $validator->getMessageBag();
            return ResponseFormatter::error(null, $message);
        }

        if($request->file('img_url')){
            $img_url = $request->file('img_url')->store('img-product');
        }

        $newProduct = [
            'name' => $request->name,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'stock' => $request->stock,
            'img_url' => $img_url,
            'description' => $request->description,
            'seller_id' => auth()->user()->userable_id
        ];
        $data = $serviceProduct->updateProduct($id,$newProduct);

        if ($data) {
            # code...
            return ResponseFormatter::success($data,"update product successfully..");
        } else {
            return ResponseFormatter::error(null,"unsuccess create a new product..");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, ProductService $serviceProduct)
    {
        //
        $deleteProduct = $serviceProduct->deleteProduct($id);

        if ($deleteProduct != null) {
            # code...
            return ResponseFormatter::success(null,"delete data successfully");
        } else {
            
            return ResponseFormatter::error(null, "delete data unsuccess, product not found");
        }
    } 
}
