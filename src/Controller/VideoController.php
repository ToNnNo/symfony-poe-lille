<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class VideoController extends AbstractController
{

    /**
     * @Route("/video/{alias}", name="video_index", defaults={ "alias": "Harry-Potter-L-Heritage-de-Poudlard" })
     */
    public function index($alias, SluggerInterface $slugger): Response
    {

        $harry = $slugger->slug('Harry Potter L’Héritage de Poudlard');
        $spiderman = $slugger->slug('spiderman');
        $kenobi = $slugger->slug('kenobi');

        $videos = [
            $harry->toString() => '8IHwNrnfI_U',
            $spiderman->toString() => 'AMJ6O-QgwHU',
            $kenobi->toString() => '2rt7fMY-Uyc'
        ];

        $code = $videos[$alias] ?? null;

        if(null == $code){
            throw $this->createNotFoundException();
        }

        return $this->render('video/index.html.twig', [
            'videos' => $videos,
            'code' => $code
        ]);
    }
}
