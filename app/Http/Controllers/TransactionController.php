<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaction;
use App\Models\Product;
use App\Models\Transaction;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cart = Cart::content();

        // dd($cart);

        if ($cart->count() == null)
        {
            return redirect()->back()->with('error', 'opps cart anda masih kosong');
        } else{
            return view('cart.checkout', compact('cart'));   
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
        // dd($request->all());

        $request->validate([
            'name' => 'required|max:255|string',
            'address' => 'string|required',
            'email' => 'required|email',
            'no_telp' => 'string|required',
        ]);
        
        DB::beginTransaction();

        $lastId = Transaction::latest('id')->first();
        $getlastId = 0;

        if($lastId){
            $getlastId = $lastId->id;
        }

        $transaction = Transaction::create([
            'invoice_number' => 'BELI-'.str_pad($getlastId+1,5,0,STR_PAD_LEFT),
            'user_id' => auth()->user()->id,
            'name' => $request->input('name'),
            'address' => $request->input('address'),
            'email' => $request->input('email'),
            'no_telp' => $request->input('no_telp'),
            'payment_gateway' => $request->input('flexRadioDisabled'),
            'total_price' => Cart::subtotal(0),
        ]);

        foreach (Cart::content() as $product ) {
            $availableStock = Product::where('id',$product->id)->first();

            if ($product->qty <= $availableStock->stock) {
                DetailTransaction::create([
                    'user_id' => auth()->user()->id,
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'category' => $availableStock->category->name,
                    'transaction_id' => $transaction->id,
                    'qty'=>$product->qty,
                ]);

                Cart::destroy();

                DB::commit();

            } else {

                DB::rollBack();
                
                return redirect('cart')->with('nostock', 'jumlah belii ' .$product->name. ' melebihi stok');
            }
        }
    
        return redirect('/history')->with('success', 'terima kasih pesanan anda segera diproses');
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
        $detailProduct = DetailTransaction::where('transaction_id', $id)->get();
        $transaction = Transaction::where('id', $id)->first();
        // dd($detailProduct);
        return view('admin.detailOrder', compact('detailProduct', 'id', 'transaction'));
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
