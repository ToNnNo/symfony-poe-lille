<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("", name="admin_index")
     */
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', []);
    }

    /**
     * @Route("/information", name="admin_information")
     */
    public function information(): Response
    {
        return $this->render('admin/information.html.twig', []);
    }

    /**
     * @Route("/useless", name="admin_useless")
     * @IsGranted("ROLE_SUPERADMIN")
     */
    public function useless(): Response
    {
        return $this->render('admin/useless.html.twig', [
            'name' => 'useless'
        ]);
    }

    /**
     * @Route("/useless/bis", name="admin_useless_bis")
     */
    public function uselessbis(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_SUPERADMIN', null, 'Access Denied: ROLE_SUPERADMIN required');

        // $this->isGranted('ROLE_SUPERADMIN');

        return $this->render('admin/useless.html.twig', [
            'name' => 'useless bis'
        ]);
    }

    /**
     * @Route("/voter", name="admin_voter")
     */
    public function voter(): Response
    {
        // Accessible aux SUPERADMIN et à l'ADMIN (1) dont le username est "admin"

        $this->denyAccessUnlessGranted('view');

        return $this->render('admin/voter.html.twig', []);
    }


}
