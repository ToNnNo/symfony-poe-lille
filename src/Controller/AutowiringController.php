<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AutowiringController extends AbstractController
{

    /**
     * @Route("/autowiring", name="autowiring_index")
     */
    public function index(LoggerInterface $logger): Response
    {

        $logger->info("Nous apprenons à nous servir de l'autowiring !");

        return $this->render('autowiring/index.html.twig', []);
    }
}
