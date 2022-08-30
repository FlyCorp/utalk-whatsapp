<?php

namespace FlyCorp\UtalkWhatsapp;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\RuntimeException;
use Cache;
use \GuzzleHttp\Client as HttpClient;

class UtalkWhatsappHelper
{
    /**
     * Get the app's version string
     *
     * If a file <base>/version exists, its contents are trimmed and used.
     * Otherwise we get a suitable string from `git describe`.
     *
     * @throws Exception\CouldNotGetVersionException if there is no version file and `git
     * describe` fails
     * @return string Version string
     */
    public static function send($token,$number,$text)
    {
        
        $number = sprintf( "%s@c.us",preg_replace( '/[^0-9]/', '', $number ));

        $zap = new HttpClient();

                    $response = $zap->post("https://v1.utalk.chat/send/`{$token}`", [
                        'form_params' => [
                            'cmd'     => 'chat',
                            'token'   => `{$token}`,
                            "to"      =>  $number,
                            "msg"     =>  $text
                        ]
                    ]);

        return json_encode($response);

    }
   
}
