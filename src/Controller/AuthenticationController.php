<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AuthenticationController extends AbstractController
{
    /**
     * @Route("/authentication", name="authentication_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if($this->getUser()){
            return $this->redirectToRoute('admin_index');
        }

        // erreur d'authentification
        $error = $authenticationUtils->getLastAuthenticationError();

        // dernier username saisie par l'utilisateur
        $username = $authenticationUtils->getLastUsername();

        return $this->render('authentication/login.html.twig', [
            'error' => $error,
            'username' => $username
        ]);
    }

    /**
     * @Route("/logout", name="authentication_logout")
     */
    public function logout(): Response
    {
        throw new \LogicException('Ne devrait pas être affiché !');
    }
}
