<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }
    /**
     * @Route("/", name="homePage")
     */
    public function index(): Response
    {
        $this->session->remove('lang');
        if($this->session->get('lang')){
            return $this->redirectToRoute('page', [
                'lang'=>$this->session->get('lang'),
            ]);
        }
        return $this->render('pages/index.html.twig', [

        ]);
    }

    /**
     * @Route("/{lang}", name="page")
     */
    public function page($lang): Response
    {
        $this->session->set('lang', $lang);
        return $this->render('pages/page.html.twig', [
            'lang'=>$lang,
        ]);
    }
}
