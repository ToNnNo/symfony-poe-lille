<?php

namespace App\Controller;

use App\Service\Cipher\CipherInterface;
use App\Service\UploadFileManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\All;
use Symfony\Component\Validator\Constraints\Image;

class ServiceController extends AbstractController
{
    /**
     * @Route("/service", name="service_index")
     */
    public function index(Request $request, CipherInterface $cipher): Response
    {

        $crypted = null;

        $form = $this->createFormBuilder()
            ->add('message', TextType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Entrer un message secret ...'
                ]
            ])
            ->getForm();

        $form->handleRequest($request);

        if ( $form->isSubmitted() ) {
            $data = $form->getData();

            $crypted = $cipher->encode($data['message']);
        }

        return $this->render('service/index.html.twig', [
            'formView' => $form->createView(),
            'crypted' => $crypted
        ]);
    }

    /**
     * @Route("/service/formulaire", name="service_formulaire")
     */
    public function formulaire(Request $request, UploadFileManager $manager): Response
    {
        $path = null;

        $form = $this->createFormBuilder()
            ->add('image', FileType::class, [
                'required' => false,
                'multiple' => true, // add this
                'attr' => [
                    'class' => 'form-control'
                ],
                'error_bubbling' => true,
                'constraints' => [
                    new All([
                        new Image([
                            'maxSize' => '2M',
                            'maxWidth' => '500'
                        ])
                    ])
                ]
            ])
            ->getForm();

        $form->handleRequest($request);

        if ( $form->isSubmitted() && $form->isValid() ) {
            $data = $form->getData();

            /* start change here */

            foreach($data['image'] as $i => $image){
                $manager->uploadFile($image, $i);
            }

            /* end change here */


            //$uploadedFile = $manager->uploadFile($data['image']);

            // $path = $uploadedFile->getPathname();
        }


        return $this->render('service/formulaire.html.twig', [
            'formView' => $form->createView(),
            'path' => $path
        ]);
    }
}
