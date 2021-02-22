<?php

namespace App\Controller;

use App\Repository\ImageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminImageController extends AbstractController
{
    private $imageRepository;

    public function __construct(ImageRepository $imageRepository)
    {
        $this->imageRepository = $imageRepository;
    }

    /**
     * @Route("/admin/image", name="admin_image")
     */
    public function index(): Response
    {
        $images = $this->imageRepository->findAll();
        return $this->render('admin_image/index.html.twig', [
            'images' => $images,
        ]);
    }
}
