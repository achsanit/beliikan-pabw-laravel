<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseFormatter;
use App\Models\User;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Service\EmailService;
use App\Models\DetailTransaction;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Service\Customer\TransactionService;
use App\Service\Seller\AuthService;
use App\Service\ShippingService;
use Exception;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    protected $serviceShipping;
    protected $serviceAuth;
    protected $serviceTransaction;

    public function __construct(
        ShippingService $serviceShipping, 
        AuthService $serviceAuth,
        TransactionService $serviceTransaction
    ) 
    {
        $this->serviceShipping = $serviceShipping;
        $this->serviceAuth = $serviceAuth;
        $this->serviceTransaction = $serviceTransaction;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id = null, Request $request)
    {
        $userId = $request->input('user_id');
        // return response()->json($user_id);

        $transaction = Transaction::latest('id');

        if ($userId) {
            # code...
            $transaction = DB::table('transactions')->where('user_id', $userId)->get();
        } else {
            # code...
            $transaction = Transaction::all();
        }
        //
        try {
            //code...
            if ($id != null) {
                # code...
                $data = $this->serviceTransaction->getTransaction($id);
                return ResponseFormatter::success($data,'success to get transaction');
            } else {
                # code...
                return ResponseFormatter::success($transaction,'success to get all transaction');
            }
        } catch (\Throwable $th) {
            //throw $th;
            return ResponseFormatter::error(null, $th);
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
    public function store(Request $request, EmailService $serviceEmail)
    {
        //
        $validator = Validator::make($request->all(),[
            'address' => 'string|required',
            'no_telp' => 'string|required',
            'product_id' => 'required|integer',
            'qty' => 'required|integer',
            'user_id' => 'required|integer',
            'province_id' => 'required|integer', //destination province
            'city_id' => 'required|integer', //detination city
            'courier' => 'required|string', //courier shipping
            'service_shipping' => 'required|integer', //service_courier
        ]);

        if ($validator->fails()) {
            # code...
            return ResponseFormatter::error(null, $validator->getMessageBag());
        }

        DB::beginTransaction();

        try {
            $lastId = Transaction::latest('id')->first();
            $getlastId = 0;

            $product = Product::find($request->product_id);

            $seller = $this->serviceAuth->findSeller($product->seller_id);

            $user = User::find($request->user_id);
            $cust = Customer::find($user->userable_id);
            // $user = DB::table('users')->where('id',$request->user_id);
            // return response()->json($cust);
            // $cust = DB::table('customers')->where('id',$user->userable_id);

            $serviceCourier = $this->serviceShipping->listCost(
                $seller->city_id,
                $request->city_id,
                $request->qty * 1000,
                $request->courier
            );

            if($lastId){
                $getlastId = $lastId->id;
            }

            $newTransac = [
                'invoice_number' => 'BELI-'.str_pad($getlastId+1,5,0,STR_PAD_LEFT),
                'user_id' => $request->user_id,
                'name' => $cust->name,
                'address' => $request->input('address'),
                'email' => $user->email,
                'no_telp' => $request->input('no_telp'),
                'payment_gateway' => ' ',
                'courier' => $request->courier,
                'service_shipping' => $serviceCourier[$request->service_shipping]->service,
                'shipping' => $serviceCourier[$request->service_shipping]->cost[0]->value,
                'total_price' => $product->price * $request->input('qty') + $serviceCourier[$request->service_shipping]->cost[0]->value,
                'origin_province' => $this->serviceShipping->detailProvince($seller->province_id)->province,
                'origin_city' => $this->serviceShipping->detailCity($seller->city_id)->city_name,
                'destination_province' => $this->serviceShipping->detailProvince($request->province_id)->province,
                'destination_city'=> $this->serviceShipping->detailCity($request->city_id)->city_name,
            ];

            $transaction = Transaction::create($newTransac);

            $detail = [
                'user_id' => $request->user_id,
                'product_id' => $product->id,
                'name' => $product->name,
                'category' => $product->category->name,
                'transaction_id' => $transaction->id,
                'qty'=>$request->qty,
                'price' => $product->price * $request->input('qty'),
            ];

            $detailTransac = DetailTransaction::create($detail);

            DB::commit();

            // $serviceEmail->sendinblue($user, $transaction, $detailTransac, $product);

            // // Mail::to($user->email)->send(new WelcomeMail());

            $data = [
                'transaction' => $transaction,
                'detail' => $detailTransac
            ];

            return ResponseFormatter::success($data, "create new transaction successfully..");

        } catch (Exception $th) {
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
