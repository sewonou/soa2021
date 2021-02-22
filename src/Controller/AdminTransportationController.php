<?php

namespace App\Controller;

use App\Entity\Transportation;
use App\Form\TransportationType;
use App\Repository\TransportationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminTransportationController extends AbstractController
{
    private $manager;
    private $transportationRepository;


    public function __construct(EntityManagerInterface $manager, TransportationRepository $transportationRepository)
    {
        $this->manager = $manager;
        $this->transportationRepository = $transportationRepository;
    }

    /**
     * @Route("/admin/transportation", name="admin_transportation")
     */
    public function index(): Response
    {
        $transports = $this->transportationRepository->findAll();
        return $this->render('admin/transportation/index.html.twig', [
            'transports' => $transports,
        ]);
    }

    /**
     * @Route("/admin/transportation/new", name="admin_transportation_create")
     * @param Request $request
     * @return Response
     */
    public function create(Request $request):Response
    {
        $transportation = new Transportation();
        $form = $this->createForm(TransportationType::class, $transportation);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->addFlash('adminsuccess', "Le moyen de transport a été ajouter avec succès");
            $this->manager->persist($transportation);
            $this->manager->flush();
            return $this->redirectToRoute('admin_transportation');
        }
        return $this->render('admin/transportation/form.html.twig', [
            'form'=> $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/transportation/{id}/edit", name="admin_transportation_edit")
     * @param Request $request
     * @param Transportation $transportation
     * @return Response
     */
    public function edit(Request $request, Transportation $transportation):Response
    {
        $form = $this->createForm(TransportationType::class, $transportation);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->addFlash('adminsuccess', "Le monyen de transport a été modifier avec succès");
            $this->manager->persist($transportation);
            $this->manager->flush();

            return $this->redirectToRoute('admin_transportation');
        }
        return $this->render('admin/transportation/form.html.twig', [
            'form'=> $form->createView(),
            'transportation' => $transportation,
        ]);
    }

    /**
     * @Route("/admin/transportation/{id}/delete", name="admin_transportation_delete")
     * @param Transportation $transportation
     * @return Response
     */
    public function delete( Transportation $transportation):Response
    {
        $this->manager->remove($transportation);
        $this->manager->flush();
        $this->addFlash(
            'success',
            "Le moyen de transport a bien été supprimer"
        );
        return $this->redirectToRoute('admin_transportation');
    }
}
