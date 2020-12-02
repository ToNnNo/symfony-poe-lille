<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PresentationController extends AbstractController
{
    /**
     * @Route("/presentation", name="presentation_index")
     */
    public function index(): Response
    {

        return $this->render('presentation/index.html.twig', []);
    }

    /**
     * @Route("/presentation/{name}", name="presentation_parameters", requirements={"name"="\w+"})
     */
    public function parameters($name): Response
    {

        // [a-z]+ -> accepte tous les caractères alphabétique (a à z), une fois ou plus

        return $this->render('presentation/parameters.html.twig', [
            'name' => ucfirst($name)
        ]);
    }

    /**
     * @Route("/presentation/liste", name="presentation_liste", priority=1)
     */
    public function liste(): Response
    {
        // default value defined is 0

        return $this->render('presentation/liste.html.twig', []);
    }

    /**
     * @Route("/presentation/json", name="presentation_json", priority=1)
     */
    public function json_response(): Response
    {
        $formation = [
            'name' => 'Symfony init + appro',
            'formateur' => 'Stéphane',
            'participants' => [
                'Anais D', 'Anais R', 'Aurélien', 'Zainab', 'Damien', 'Fabien',
                'Inès', 'Nélida', 'Pierre', 'Quentin', 'Rémi', 'Soufiane', 'Victor'
            ]
        ];


        return $this->json($formation); // fournir une réponse au format json
    }

    /**
     * @Route("/presentation/redirect", name="presentation_redirect", priority=1)
     */
    public function redirect_response(): Response
    {
        // permet de déclencher une redirection http
        return $this->redirectToRoute('presentation_parameters', ['name' => 'victor']);
    }

    /**
     * @Route("/presentation/download", name="presentation_download", priority=1)
     */
    public function download_response(): Response
    {

        // permet de forcer le téléchargement d'un fichier
        return $this->file('images/404_error.jpg');
    }
}
