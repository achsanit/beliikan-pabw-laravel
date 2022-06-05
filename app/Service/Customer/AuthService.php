<?php

namespace App\Service\Customer;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AuthService
{
    public function customerRegister($user,$customer)
    {
        DB::beginTransaction();

        try {
            //create customer
            $newCustomer = Customer::create($customer);

            //create user
            $user['userable_id'] = $newCustomer->id;
            $newUser = User::create($user);

            DB::commit();

            $response = [
                'status_code' => 201,
                'success' => true,
                'message' => 'Customer created successfully',
                'data' => $newUser
            ];

            return $response;

        } catch (\Throwable $th) {
            DB::rollBack();

            $response = [
                'status_code' => 400,
                'success' => false,
                'message' => $th,
                'data' => 'null'
            ];

            return $response;
        }
    }

    public function findCustomer($id) 
    {
        return Customer::find($id);
    } 
}