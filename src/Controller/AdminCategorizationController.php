<?php

namespace App\Controller;

use App\Entity\Categorization;
use App\Form\CategorizationType;
use App\Repository\CategorizationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminCategorizationController extends AbstractController
{
    private $manager;
    private $categorizationRepository;


    public function __construct(EntityManagerInterface $manager, CategorizationRepository $categorizationRepository)
    {
        $this->manager = $manager;
        $this->categorizationRepository = $categorizationRepository;
    }

    /**
     * @Route("/admin/categorization", name="admin_categorization")
     */
    public function index(): Response
    {
        $categorizations = $this->categorizationRepository->findAll();
        return $this->render('admin/categorization/index.html.twig', [
            'categorizations' => $categorizations,
        ]);
    }

    /**
     * @Route("/admin/categorization/new", name="admin_categorization_create")
     * @param Request $request
     * @return Response
     */
    public function create(Request $request): Response
    {
        $categorization = new Categorization();
        $form = $this->createForm(CategorizationType::class, $categorization);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->addFlash(
                'adminsuccess',
                "La& catégorie de participants a été ajouter avec succès"
            );
            $this->manager->persist($categorization);
            $this->manager->flush();
            return $this->redirectToRoute('admin_categorization');
        }

        return $this->render('admin/categorization/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/categorization/{id}/edit", name="admin_categorization_edit")
     * @param Request $request
     * @param Categorization $categorization
     * @return Response
     */
    public function edit(Request $request, Categorization $categorization): Response
    {

        $form = $this->createForm(CategorizationType::class, $categorization);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->addFlash(
                'adminsuccess',
                "La& catégorie de participants a été modifier avec succès"
            );
            $this->manager->persist($categorization);
            $this->manager->flush();
            return $this->redirectToRoute('admin_categorization');
        }

        return $this->render('admin/categorization/form.html.twig', [
            'form' => $form->createView(),
            'categorization' => $categorization,
        ]);
    }

    /**
     * @Route("/admin/categorization/{id}/delete", name="admin_categorization_delete")
     * @param Categorization $categorization
     * @return Response
     */
    public function delete(Categorization $categorization) :Response
    {
        $this->manager->remove($categorization);
        $this->manager->flush();;
        $this->addFlash(
            'adminsuccess',
            "La catégorie de participant a été supprimer avec succès"
        );
    }
}
