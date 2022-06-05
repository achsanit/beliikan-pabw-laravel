<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseFormatter;
use Illuminate\Http\Request;
use App\Service\ProductService;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    protected $serviceProduct;

    public function __construct(ProductService $serviceProduct)
    {
        $this->serviceProduct = $serviceProduct;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {

        $categories = $request->category_id;
        $name = $request->name;
        $seller_id = $request->seller_id;

        // todo
        $products = $this->serviceProduct->index();

        if ($seller_id) {
            # code...
            $products->where('seller_id', $seller_id);
        }
        
        if ($categories) {
            # code...
            $products->where('category_id', $categories);
        }

        if ($name) {
            # code...
            $products->where('name', 'like', '%'.$name.'%');
        }

        if ($products) {
            # code...
            return ResponseFormatter::success($products->paginate(20),"susccess get products");
        } else {
            # code...
            return ResponseFormatter::error(null,"failed to get products");
        }
    
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
    public function store(Request $request)
    {
        //
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
        $product = $this->serviceProduct->show($id);

        if ($product) {
            # code...
            return ResponseFormatter::success($product,"susccess get product");
        } else {
            # code...
            return ResponseFormatter::error(null,"failed to get product");
        }
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
    public function update(Request $request, $id)
    {
        //
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
    }
}
