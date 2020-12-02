<?php

namespace App\Controller;

use App\Entity\Livre;
use App\Form\LivreType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FormController extends AbstractController
{
    /**
     * @Route("/formulaire", name="form_index")
     */
    public function index(Request $request): Response
    {
        $form = $this->createForm(LivreType::class, new Livre());
        $form->handleRequest($request);

        if ( $form->isSubmitted() && $form->isValid() ) {
            $livre = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($livre);
            $em->flush();

            $this->addFlash('success', 'Votre livre a bien été ajouté');

            return $this->redirectToRoute('form_index');
        }

        return $this->render('form/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
