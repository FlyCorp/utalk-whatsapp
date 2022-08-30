<?php

namespace FlyCorp\UtalkWhatsapp;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\RuntimeException;
use Cache;
use \GuzzleHttp\Client as HttpClient;

class UtalkWhatsappHelper
{
/**
* M;etodo responsável por enviar mesnagems via whatsaoo poe meio da ferramenta UMBLER
* 
* @param string $token Chave de acesso que deve ser  adiquirida na ferramenta Utalk.
* @param string $number Numero de telefone no formato vide exemplo 5531996141290 , onde temos CodPais | DDD | Numero
* @param string $text Mensagem a ser enviada.

* @return object Retorno do endpont.
*/
    public static function send($token,$number,$text)
    {
        
        try {

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
    
            return json_decode($response->getBody()->getContents());
    
        } catch (\Throwable $th) {

           return json_encode([

                "status" => "error",
                "trace"  => $th
                
            ]);

        }

    }
   
}
