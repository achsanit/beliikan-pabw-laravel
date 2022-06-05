<?php

namespace App\Service;

use App\Models\User;

class UserService
{
    public function findUser($id) 
    {
        return User::find($id);
    }
} 