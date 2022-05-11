<?php

namespace App\Mail;

use App\Models\DetailTransaction;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TransactionMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;
    protected $product;
    protected $transaction;
    protected $detailTransaction;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Product $product, Transaction $transaction, DetailTransaction $detailTransaction)
    {
        //
        $this->user = $user;
        $this->product = $product;
        $this->transaction = $transaction;
        $this->detailTransaction = $detailTransaction;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('achsanit87@gmail.com', 'achsanit')
        ->markdown('mail.transaction-mail')->with([
            'username'=> $this->user->name,
            'invoice'=> $this->transaction->invoice_number,
            'product'=>$this->product->name,
            'address'=> $this->transaction->address,
            'total'=> $this->transaction->total_price,
        ]);
    }
}
