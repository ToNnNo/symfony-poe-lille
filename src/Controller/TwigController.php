<?php

namespace App\Controller;

use App\Useless\Person;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TwigController extends AbstractController
{
    /**
     * @Route("/twig", name="twig_index")
     */
    public function index(): Response
    {

        $date = new \DateTime();

        // fait afficher le contenu de la fonction dans la barre de debug
        // Les dump() doivent tous être supprimé avant la mise en prod
        dump($date, 'coucou');

        $person = new Person("Doe", "John");

        $array_assoc = [
            'nom' => 'Symfony init + appro',
            'lieu' => 'Lille'
        ];

        return $this->render('twig/index.html.twig', [
            'name' => "Stéphane",
            'date' => $date,
            'person' => $person,
            'formation' => $array_assoc
        ]);
    }

    /**
     * @Route("/twig/next", name="twig_next")
     */
    public function next(): Response
    {
        $participants = [
            'Anais D', 'Anais R', 'Aurélien', 'Zainab', 'Damien', 'Fabien',
            'Inès', 'Nélida', 'Pierre', 'Quentin', 'Rémi', 'Soufiane', 'Victor'
        ];

        $array = [];

        $produits = [
            [ 'name' => 'Pomme', 'quantite' => 12 ],
            [ 'name' => 'Poire', 'quantite' => 1 ],
            [ 'name' => 'Cerise', 'quantite' => 0 ],
        ];

        return $this->render('twig/next.html.twig', [
            'participants' => $participants,
            'array' => $array,
            'produits' => $produits,
        ]);
    }

    /**
     * @Route("/twig/mixed", name="twig_mixed")
     */
    public function mixed(): Response
    {
        $html = "<em>Je suis un texte au format html</em>";

        $content = <<<EOF
            <div>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus possimus recusandae 
                    reiciendis sit veritatis. Aliquam architecto aut debitis dicta, hic laboriosam libero minus non 
                    obcaecati sint totam, vero vitae, voluptatum.
                </p>
                <p>
                    $html
                </p>
            </div>
EOF;


        return $this->render('twig/mixed.html.twig', [
            'html' => $html,
            'content' => $content,
            'name' => 'Jean Durand'
        ]);
    }

    /**
     * @Route("/twig/notfound", name="twig_notfound")
     */
    public function notfound(): Response
    {

        throw $this->createNotFoundException("Ceci est un exemple d'erreur 404 en dev !");
    }
}
