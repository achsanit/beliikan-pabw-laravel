<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Mail\WelcomeMail;
use App\Models\DetailTransaction;
use App\Models\User;
use App\Service\EmailService;
use Illuminate\Support\Facades\Mail;

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
    public function store(Request $request, EmailService $serviceEmail)
    {
        //
        $request->validate([
            'address' => 'string|required',
            'no_telp' => 'string|required',
            'product_id' => 'required|integer',
            'qty' => 'required|integer',
            'user_id' => 'required|integer',
        ]);

        DB::beginTransaction();

        try {
            $lastId = Transaction::latest('id')->first();
            $getlastId = 0;

            $product = Product::find($request->input('product_id'));

            $user = User::find($request->input('user_id'));

            if($lastId){
                $getlastId = $lastId->id;
            }

            $transaction = Transaction::create([
                'invoice_number' => 'BELI-'.str_pad($getlastId+1,5,0,STR_PAD_LEFT),
                'user_id' => $request->input('user_id'),
                'name' => $user->name,
                'address' => $request->input('address'),
                'email' => $user->email,
                'no_telp' => $request->input('no_telp'),
                'payment_gateway' => ' ',
                'total_price' => $product->price * $request->input('qty'),
            ]);

            $detailTransac = DetailTransaction::create([
                'user_id' => $request->input('user_id'),
                'product_id' => $product->id,
                'name' => $product->name,
                'category' => $product->category->name,
                'transaction_id' => $transaction->id,
                'qty'=>$request->input('qty'),
            ]);
            // dd($detailTransac);

            DB::commit();

            $serviceEmail->sendinblue($user, $transaction, $detailTransac, $product);

            // Mail::to($user->email)->send(new WelcomeMail());

            return response()->json($detailTransac);

        } catch (\Throwable $th) {
            DB::rollBack();

            return response()->json($th,400);

        }

        

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
