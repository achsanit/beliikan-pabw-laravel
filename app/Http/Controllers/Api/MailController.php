<?php
namespace App\Http\Controllers\Api;

use Mailgun\Mailgun;
use GuzzleHttp\Client;
use App\Http\Controllers\Controller;
use App\Service\EmailService;
use Exception;
use SendinBlue\Client\Configuration;
use SendinBlue\Client\Model\SendSmtpEmail;
use Mailjet\LaravelMailjet\Facades\Mailjet;
use SendinBlue\Client\Api\TransactionalEmailsApi;

class MailController extends Controller
{
    public function sendProduction(EmailService $serviceEmail) 
    {
      // return $serviceEmail->sendinblue();
    }

    public function send()
    {
        $mailjet = Mailjet::getClient(getenv('MAILJET_APIKEY'), getenv('MAILJET_SECRETKEY'),true,['version'=>'v3.1']);
        $body = [
            'SandboxMode' => "true",
            'Messages' => [
              [
                'From' => [
                  [
                    'Email' => "achsanit87@gmail.com",
                    'Name' => "achsanit"
                  ]
                ],
                'HTMLPart' => "<h3>Dear passenger, welcome to Mailjet!</h3><br />May the delivery force be with you!",
                'Subject' => "Your email flight plan!",
                'TextPart' => "Dear passenger, welcome to Mailjet! May the delivery force be with you!",
                'To' => [
                  [
                    'Email' => "11191002@student.itk.ac.id",
                    'Name' => "11191002"
                  ]
                ]
              ]
            ]
          ];
        
        // $responseBody = isset($body)? $body : [];
        // dd($body);

        $response = $mailjet->post(['body' => $body]);
        $response->success() && dd($response->getData());
    }

    public function sendMailgun()
    {
        $api_key = getenv('MAILGUN_SECRET');
        $domain = getenv('MAILGUN_DOMAIN');

        $mailgunClient = Mailgun::create($api_key);
        
        $params = [
            'from' => 'achsanit <no-reply@sandboxdab01673e514419faaba95fdd0ae6565.mailgun.org>',
            'to' => 'achsanit87@gmail.com',
            'subject' => 'Hello',
            'text' => 'Testing sending email with mailgun'
        ];

        // dd(json_decode($params));

        $mailgunClient->messages()->send($domain, $params);
        $response = [
            'message'=>"email terkirim",
            'data'=>$params,
        ];
        
        return response()->json($response);
    }

    // public function sendinblue() 
    // {
    //   $defaultConf = Configuration::getDefaultConfiguration()->setApiKey("api-key",getenv('SENDINBLUE_APIKEY'));
    //   $instance = new TransactionalEmailsApi(new Client(),$defaultConf);

    //   $sendSmtpEmail = new SendSmtpEmail([
    //     'subject' => 'from the PHP SDK!',
    //     'sender' => ['name' => 'Beliikan', 'email' => 'achsanit87@gmail.com'],
    //     'to' => [[ 'name' => 'achsani', 'email' => '11191002@student.itk.ac.id']],
    //     'htmlContent' => '<html><body><h1>This is a transactional email {{params.bodyMessage}}</h1></body></html>',
    //     'params' => ['bodyMessage' => 'made just for you!']
    //   ]);

    //   $response = [
    //     'message'=>'tidak berhasil',
    //     'data'=>$sendSmtpEmail
    //   ];

    //   try {
    //     $instance->sendTransacEmail($sendSmtpEmail);
    //     $response['message'] = 'berhasil terkirim';
    //     return response()->json($response);
    //   } catch (Exception $e) {
    //     echo $e->getMessage(),PHP_EOL;
    //     $response['message']=$e;
    //     return response()->json($response);
    //   }

    // }
}
