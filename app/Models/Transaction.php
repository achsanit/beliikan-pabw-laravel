<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\CssSelector\Node\FunctionNode;

class Transaction extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    
    protected $fillable = [
        'user_id',
        'address',
        'payment_gateway',
        'total_price',
        'shipping',
        'status',
        'email',
        'no_telp',
        'name',
        'invoice_number',
        'origin_province',
        'origin_city',
        'destination_province',
        'destination_city',
        'service_shipping',
        'courier'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function detailTransactions()
    {
        return $this->hasMany(DetailTransaction::class);
    }
}
