<?php

namespace App\Service\Customer;

use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class TransactionService
{
    public function getAllTransaction() 
    {
        $data = Transaction::all();

        return $data;
    }

    public function getTransaction($id)
    {
        $data = Transaction::where('id', $id)->get();

        return $data;
    }
}