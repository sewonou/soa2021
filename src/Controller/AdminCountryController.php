<?php

namespace App\Controller;

use App\Entity\Country;
use App\Form\CountryType;
use App\Repository\CountryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminCountryController extends AbstractController
{
    private $manager;
    private $countryRepository;

    public function __construct(EntityManagerInterface $manager, CountryRepository $countryRepository)
    {
        $this->manager = $manager;
        $this->countryRepository = $countryRepository;
    }


    /**
     * @Route("/admin/country", name="admin_country")
     * @return Response
     */
    public function index(): Response
    {
        $countries = $this->countryRepository->findAll();

        return $this->render('admin/country/index.html.twig', [
            'countries' => $countries,
        ]);
    }

    /**
     * @Route("/admin/country/new", name="admin_country_create")
     * @param Request $request
     * @return Response
     */
    public function create(Request $request):Response
    {
        $country = new Country();
        $form = $this->createForm(CountryType::class, $country);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->addFlash(
                'adminsuccess',
                "Le pays a bien été ajouter avec succès"
            );
            $this->manager->persist($country);
            $this->manager->flush();
            return $this->redirectToRoute('admin_country');
        }
        return $this->render('admin/country/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/country/{id}/edit", name="admin_country_edit")
     * @param Request $request
     * @param Country $country
     * @return Response
     */
    public function edit(Request $request, Country $country): Response
    {
        $form = $this->createForm(CountryType::class, $country);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->addFlash(
                'adminsuccess',
                "Le pays a bien été modifier avec succès"
            );
            $this->manager->persist($country);
            $this->manager->flush();
            return $this->redirectToRoute('admin_country');
        }
        return $this->render('admin/country/form.html.twig', [
            'form' => $form->createView(),
            'country' => $country,
        ]);
    }

    /**
     * @Route("/admin/country/{id}/delete", name="admin_country_delete")
     * @param Country $country
     * @return Response
     */
    public function delete(Country $country):Response
    {
        $this->manager->remove($country);
        $this->manager->flush();

        $this->addFlash(
            'adminsuccess',
            "Le pays à bien été supprimer"
        );
        return $this->redirectToRoute('admin_country');
    }
}
