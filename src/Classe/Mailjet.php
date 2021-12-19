<?php

namespace App\Classe;

use Mailjet\Client;
use Mailjet\Resources;
use Symfony\Bridge\Twig\TokenParser\DumpTokenParser;

class Mailjet
{
    private $api_key = '2eb2ad93c4e4199cc4d30d401da0339a';
    private $api_key_secret =  '7485eac136469430640ffa95c8a0355b';
    private $email = "dgsrsrp@gmail.com";
    private $templateID  = 3370123;

    public function send($contenu)
    {

        $mj = new Client($this->api_key, $this->api_key_secret, true, ['version' => 'v3.1']);

        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => $this->email,
                        'Name' => "DGSR/DOR/SRP"
                    ],
                    'To' => [
                        [
                            'Email' => $this->email,
                            'Name' => "DGSR/DOR/SRP"
                        ]
                    ],
                    'TemplateID' => $this->templateID,
                    'TemplateLanguage' => true,
                    'Subject' => 'Mot de passe oublié',
                    'Variables' => [
                        'contenu' => $contenu,
                    ]
                ]
            ]
        ];
        $response = $mj->post(Resources::$Email, ['body' => $body]);
        $response->success();
    }
}
