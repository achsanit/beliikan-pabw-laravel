<?php

namespace App\Service;

use App\Mail\SuccessOrderMail;
use App\Mail\SuccessTransaction;
use App\Mail\TransactionMail;
use App\Models\DetailTransaction;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Mail;
use SendinBlue\Client\Configuration;
use SendinBlue\Client\Model\SendSmtpEmail;
use SendinBlue\Client\Api\TransactionalEmailsApi;

class EmailService 
{
    public function sendinblue(User $user, Transaction $transaction, DetailTransaction $detailTransac, Product $product)
    {
        $defConf = Configuration::getDefaultConfiguration()
                        ->setApiKey("api-key", getenv('SENDINBLUE_APIKEY'));

        $instance = new TransactionalEmailsApi(new Client(), $defConf);

        $newEmail = new SendSmtpEmail([
            'subject' => 'Successful Beliikan Transaction!',
            'sender' => ['name' => 'Beliikan', 'email' => 'achsanit87@gmail.com'],
            'to' => [[ 'name' => $user->name, 'email' => $user->email]],
            'templateId' => 1,
            'params' => [
                'username' => $user->name, 
                'invoice'=>$transaction->invoice_number,
                'name_product'=>$product->name,
                'qty'=>$detailTransac->qty,
                'address' => $transaction->address,
                'total_price' => $transaction->total_price,
            ]
        ]);

        $response = [
            'message'=>'tidak berhasil',
            'data'=>$newEmail
          ];
    
        try {
            $instance->sendTransacEmail($newEmail);
            $response['message'] = 'berhasil terkirim';
        } catch (Exception $e) {
            echo $e->getMessage(),PHP_EOL;
            $response['message']=$e;
        }
    }

    // public function mailtrap(User $user, Product $product, Transaction $transaction, DetailTransaction $detailTransaction) 
    // {
    //     return Mail::to($user->email)->send(new TransactionMail($user, $product, $transaction, $detailTransaction));
    // }
}