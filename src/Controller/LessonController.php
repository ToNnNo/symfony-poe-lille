<?php

namespace App\Controller;

use App\Useless\Doctor;
use App\Useless\Person;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LessonController extends AbstractController
{
    /**
     * @Route("/lesson", name="lesson_index")
     */
    public function index(): Response
    {

        $patient = new Person("Doe", "John");

        $doctor = new Doctor("Docteur", "Le",
            "Généraliste", "Tournevis Sonique");

        $patient2 = new Doctor("Doe", "Jane",
            "Chirurgienne", "Bistouri");

        $message = $doctor->heal($patient);

        $message2 = $doctor->heal($patient2); // polymorphisme

        return $this->render('lesson/index.html.twig', [
            'message' => $message,
            'message2' => $message2
        ]);
    }
}
