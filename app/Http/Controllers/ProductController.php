<?php

namespace App\Http\Controllers;


use App\Models\Product;
use Illuminate\Http\Request;
use App\Service\ProductService;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $serviceProduct;

    public function __construct(ProductService $serviceProduct)
    {
        $this->serviceProduct = $serviceProduct;
    }
    
    public function index(Request $request)
    {
        $search = $request->input('search');
        // dd($search);

        if ($search) {
            $products = Product::with('Category')->latest('id')->where('name', 'LIKE', '%'.$search.'%')->paginate(12);
        }else{
            $products = $this->serviceProduct->index();
        }

        $latestProducts = Product::latest('id')->take(3)->get();

        // dd($products);
        
        return view('products.index',compact(['products','latestProducts','search']));
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
        $product = Product::find($id);
        // dd($product);

        $productByCategory = Product::where('category_id', $product->category_id)->get();

        $anotherProduct = $productByCategory->where('id', '!=',  $product->id)->take(4);

        if($product)
        {
            return view('products.details', compact('product', 'anotherProduct'));
        }else{
            return 'tidak ada hasil';
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
