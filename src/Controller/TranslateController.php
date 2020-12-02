<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;


class TranslateController extends AbstractController
{
    /**
     * @Route("/{_locale}/translate", name="translate_index")
     */
    public function index($_locale, TranslatorInterface $translator): Response
    {

        // dump($_locale);

        $welcome = $translator->trans('welcome');

        return $this->render('translate/index.html.twig', [
            'welcome' => $welcome
        ]);
    }

    /**
     * @Route({
     *     "en": "/translate/url",
     *     "fr": "/traduire/url"
     * }, name="translate_translate_url")
     */
    public function translateUrl(TranslatorInterface $translator): Response
    {
        $welcome = $translator->trans('welcome');

        return $this->render('translate/index.html.twig', [
            'welcome' => $welcome
        ]);
    }
}
