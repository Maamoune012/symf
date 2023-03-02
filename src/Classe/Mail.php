<?php

namespace App\Classe;

use Mailjet\Client;
use Mailjet\Resources;

class Mail
{
    private $api_key = '4b29e204a2800bbd6b748c500d3b3dfe';
    private $api_key_secret = '2fe0a38fd02eba151883a2a78ddfe934';

    public function send($to_email, $to_name, $subject, $content)
    {
        $mj = new Client($this->api_key, $this->api_key_secret,true,['version' => 'v3.1']);
        // $mj = new \Mailjet\Client(getenv('MJ_APIKEY_PUBLIC'), getenv('MJ_APIKEY_PRIVATE'),true,['version' => 'v3.1']);
$body = [
    'Messages' => [
        [
            'From' => [
                'Email' => "cheickna378@gmail.com",
                'Name' => "MULTISHOP"
            ],
            'To' => [
                [
                    'Email' => $to_email,
                    'Name' => $to_name
                ]
            ],
            'TemplateID' => 4616069,
            'TemplateLanguage' => true,
            'Subject' => $subject,
            'Variables' => [
                'content' => $content,
            ]
        ]
        
    ]
];
$response = $mj->post(Resources::$Email, ['body' => $body]);
// $response->success() && dd($response->getData());
    }
}