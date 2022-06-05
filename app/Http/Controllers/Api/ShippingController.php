<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseFormatter;
use Illuminate\Http\Request;
use App\Service\ShippingService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ShippingController extends Controller
{
    //
    protected $serviceShipping;

    public function __construct(ShippingService $serviceShipping)
    {
        $this->serviceShipping = $serviceShipping;
    }

    public function getListCosts(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'origin' => 'required|integer',
            'destination' => 'required|integer',
            'weight' => 'required|integer',
            'courier' => 'required|string'
        ]);

        if ($validator->fails()) {
            # code...
            return response()->json($validator->getMessageBag());
        }

        $listCost = $this->serviceShipping->listCost(
            $request->origin, 
            $request->destination, 
            $request->weight, 
            $request->courier
        );

        return response()->json($listCost);
    }

    public function getProvince($id = null, ShippingService $serviceShipping)
    {
        try {
            //code...
            if ($id != null) {
                # code...
                $data = $serviceShipping->detailProvince($id);
                return ResponseFormatter::success($data,'success to get detail province');
            } else {
                # code...
                $data = $serviceShipping->getProvince();
                return ResponseFormatter::success($data,'success to get all province');
            }
        } catch (\Throwable $th) {
            //throw $th;
            return ResponseFormatter::error(null, $th);
        }
    }

    public function getListCity(Request $request) 
    {
        $province = $request->province;

        if ($province) {
            # code...
            $list = $this->serviceShipping->getListCity($province);

            return ResponseFormatter::success($list, 'success get list city');
        } else {
            return ResponseFormatter::error(null,'failed to get list city');
        }
    }
}
