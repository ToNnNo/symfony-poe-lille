<?php


namespace App\Service\Cipher;


interface CipherInterface
{
    public function encode(?string $chaine): ?string;

    public function decode(?string $chaine): ?string;
}