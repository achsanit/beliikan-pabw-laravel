<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseFormatter;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Service\Customer\AuthService as CustomerAuthService;
use App\Service\Seller\AuthService;
use App\Service\UserService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    protected $serviceUser;
    protected $serviceAuthSeller;
    protected $serviceAuthCustomer;

    public function __construct(
        UserService $serviceUser,
        AuthService $serviceAuthSeller, 
        CustomerAuthService $serviceAuthCustomer
    ) {
        $this->serviceUser = $serviceUser;
        $this->serviceAuthSeller = $serviceAuthSeller;
        $this->serviceAuthCustomer = $serviceAuthCustomer;
    }

    public function customerRegister(Request $request, CustomerAuthService $customerAuthService)
    {
        $request->validate([
            'name' => 'required|string|max:366',
            'phone' => 'required|string|max:13',
            'address' => 'required|string|max:366',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|max:50'
        ]);

        $newCustomer = [
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
        ];

        $newUser = [
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'userable_type' => 'customer'
        ];

        $response = $customerAuthService->customerRegister($newUser,$newCustomer);

        return response()->json($response,$response['status_code']);
    }

    public function sellerRegister(Request $request, AuthService $authService) 
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:366',
            'phone' => 'required|string|max:13',
            'address' => 'required|string|max:366',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|max:50',
            'province_id' => 'required|integer',
            'city_id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            # code...
            $data = ['error' => $validator->getMessageBag()];
            return ResponseFormatter::error($data,"error validator");
        }

        $newSeller = [
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'province_id' => $request->province_id,
            'city_id' => $request->city_id
        ];

        $newUser = [
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'userable_type' => 'seller'
        ];

        $response = $authService->sellerRegister($newUser,$newSeller);

        // return response()->json($response);
        // return ResponseFormatter::success($response,"new user has been created");

        if ($response['user'] != null) {
            # code...
            return ResponseFormatter::success($response,'new user has been created');
        } else {
            # code...
            return ResponseFormatter::error($response['user'],$response['message']);
        }
        
    }


    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if($validator->fails())
        {
            $data = ['error' => $validator->getMessageBag()];
            return ResponseFormatter::error($data,"error validator");
        }

        if (! $token = JWTAuth::attempt($validator->validated()))
        {
            return response()->json(['error' => 'Unauthorized'],401);
        }
        return $this->createNewToken($token, auth()->user()->id);
    }

    public function logout(Request $request)
    {
        $validator = Validator::make($request->only('token'), [
            'token' => 'required'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            $data = ['error' => $validator->getMessageBag()];
            return ResponseFormatter::error($data,"error validator");
        }

		//Request is validated, do logout        
        try {
            JWTAuth::invalidate($request->token);
 
            $data = [
                'success' => true,
                'message' => 'User has been logged out'
            ];

            return ResponseFormatter::success(null,$data);

        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, user cannot be logged out',
                'exception' => $exception
            ], 500);
        }
    }

    protected function createNewToken($token,$id) 
    {
        $user = $this->serviceUser->findUser($id);

        $responseUser = [];

        if ($user->userable_type == 'seller') {

            $userType = $this->serviceAuthSeller->findSeller($user->userable_id);
            
        } elseif ($user->userable_type == 'customer') {
            # code...
            $userType = $this->serviceAuthCustomer->findCustomer($user->userable_id);
        } 

        $responseUser = [
            'id' => $userType->id,
            'name' => $userType->name,
            'phone' => $userType->phone,
            'email' => $user->email,
            'address' => $userType->address,
            'user_type' => $user->userable_type
        ];

        $data = [
            'access_token' => $token,
            'token_type' => 'bearer',
            'user' => $responseUser
        ];

        return ResponseFormatter::success($data,"login successfully");
    }
}
