<?php

namespace App\Controller;

use App\Entity\Hotel;
use App\Form\HotelType;
use App\Repository\HotelRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminHotelController extends AbstractController
{
    private $manager;
    private $hotelRepository;

    public function __construct(EntityManagerInterface $manager, HotelRepository $hotelRepository)
    {
        $this->manager = $manager;
        $this->hotelRepository = $hotelRepository;
    }

    /**
     * @Route("/admin/hotel", name="admin_hotel")
     * @return Response
     */
    public function index(): Response
    {
        $hotels = $this->hotelRepository->findAll();
        return $this->render('admin/hotel/index.html.twig', [
            'hotels' => $hotels,
        ]);
    }

    /**
     * @Route("/admin/hotel/new", name="admin_hotel_create")
     * @param Request $request
     * @return Response
     */
    public function create(Request $request): Response
    {
        $hotel = new Hotel();
        $form = $this->createForm(HotelType::class, $hotel);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->addFlash(
                'adminsuccess',
                "L'hotel à ben été ajouter avec succès"
            );
            $this->manager->persist($hotel);
            $this->manager->flush();
            return $this->redirectToRoute('admin_hotel');
        }
        return $this->render('admin/hotel/form.html.twig', [
            'form'=>$form->createView(),
        ]);
    }

    /**
     * @Route("/admin/hotel/{id}/edit", name="admin_hotel_edit")
     * @param Request $request
     * @param Hotel $hotel
     * @return Response
     */
    public function edit(Request $request, Hotel $hotel): Response
    {

        $form = $this->createForm(HotelType::class, $hotel);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->addFlash(
                'adminsuccess',
                "L'hotel à ben été modifier avec succès"
            );
            $this->manager->persist($hotel);
            $this->manager->flush();
            return $this->redirectToRoute('admin_hotel');
        }
        return $this->render('admin/hotel/form.html.twig', [
            'form'=>$form->createView(),
        ]);
    }

    /**
     * @Route("/admin/hotel/{id}/delete", name="admin_hotel_delete")
     * @param Hotel $hotel
     * @return Response
     */
    public function delete(Hotel $hotel):Response
    {
        $this->manager->remove($hotel);
        $this->manager->flush();
        $this->addFlash(
            'adminsuccess',
            "L'hotel à ben été supprimer avec succès"
        );
        return $this->redirectToRoute('admin_hotel');
    }
}
