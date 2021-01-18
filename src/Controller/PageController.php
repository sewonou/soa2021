<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    /**
     * @Route("/", name="homePage")
     */
    public function index(): Response
    {
        return $this->render('pages/index.html.twig', [
            'controller_name' => 'PageController',
        ]);
    }
}
