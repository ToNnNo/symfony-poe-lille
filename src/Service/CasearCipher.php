<?php


namespace App\Service;


use App\Service\Cipher\CipherInterface;

class CasearCipher implements CipherInterface
{

    public function encode(?string $chaine): ?string
    {
        if( null != $chaine){
            return str_rot13($chaine);
        }

        return null;
    }

    public function decode(?string $chaine): ?string
    {
        return $this->encode($chaine);
    }
}