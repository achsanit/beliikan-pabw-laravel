<?php

namespace App\Service\Seller;

use App\Models\Seller;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AuthService
{
    public function sellerRegister($user,$seller)
    {
        DB::beginTransaction();

        try {
            //create seller
            $newSeller = Seller::create($seller);

            //create user
            $user['userable_id'] = $newSeller->id;
            $newUser = User::create($user);

            DB::commit();

            $response = [
                'user' => $newUser,
                'detail_seller' => $newSeller
            ];

            return $response;

        } catch (\Throwable $th) {
            DB::rollBack();

            $response = [
                'message' => 'failed to create new user',
                'user' => null
            ];

            return $response;
        }
    }

    public function findSeller($id)
    {
        return Seller::find($id);
    }
}