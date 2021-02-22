<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminFaqController extends AbstractController
{
    /**
     * @Route("/admin/faq", name="admin_faq")
     */
    public function index(): Response
    {
        return $this->render('admin_faq/index.html.twig', [
            'controller_name' => 'AdminFaqController',
        ]);
    }
}
