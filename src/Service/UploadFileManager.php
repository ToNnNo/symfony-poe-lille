<?php


namespace App\Service;


use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Filesystem\Exception\IOException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploadFileManager
{

    // private $directory = "images/profil/";
    private $directory = null;

    public function __construct(ParameterBagInterface $parameterBag)
    {
        $this->directory = $parameterBag->get('images_directory');
    }

    public function uploadFile(UploadedFile $file, $imagename = "johndoe")
    {
        if( null == $this->directory) {
            throw new IOException('The directory does not be "null"');
        }


        $name = time().$imagename.".".$file->getClientOriginalExtension();

        return $file->move($this->directory, $name);
    }


}