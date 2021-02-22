<?php

namespace App\Controller;

use App\Entity\Calendar;
use App\Form\CalendarType;
use App\Repository\CalendarRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminEventController extends AbstractController
{
    private $manager;
    private $calendarRepository;


    public function __construct(EntityManagerInterface $manager, CalendarRepository $calendarRepository)
    {
        $this->manager = $manager;
        $this->calendarRepository = $calendarRepository;
    }

    /**
     * @Route("/admin/event", name="admin_event")
     */
    public function index(): Response
    {
        $events = $this->calendarRepository->findAll();
        return $this->render('admin/event/index.html.twig', [
            'events' => $events,
        ]);
    }

    /**
     * @Route("/admin/event/new", name="admin_event_create")
     * @param Request $request
     * @return Response
     */
    public function create(Request $request):Response
    {
        $event = new Calendar();
        $form = $this->createForm(CalendarType::class, $event);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->addFlash(
                'adminsuccess',
                "L'évènement a été ajouter avec succès"
            );
            $this->manager->persist($event);
            $this->manager->flush();
            return $this->redirectToRoute('admin_event');
        }
        return $this->render('admin/event/form.html.twig', [
            'form'=> $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/event/{id}/edit", name="admin_event_edit")
     * @param Request $request
     * @param Calendar $event
     * @return Response
     */
    public function edit(Request $request, Calendar $event):Response
    {
        $form = $this->createForm(CalendarType::class, $event);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->addFlash(
                'adminsuccess',
                "L'évenement a été modifier avec succès"
            );
            $this->manager->persist($event);
            $this->manager->flush();

            return $this->redirectToRoute('admin_event');
        }
        return $this->render('admin/event/form.html.twig', [
            'form'=> $form->createView(),
            'event' => $event,
        ]);
    }

    /**
     * @Route("/admin/event/{id}/delete", name="admin_event_delete")
     * @param Calendar $event
     * @return Response
     */
    public function delete( Calendar $event):Response
    {
        $this->manager->remove($event);
        $this->manager->flush();
        $this->addFlash(
            'success',
            "L'évenement a bien été supprimer"
        );
        return $this->redirectToRoute('admin_event');
    }

    /**
     * @Route("/admin/event/{id}/show", name="admin_event_show")
     * @param Calendar $event
     * @return Response
     */
    public function show(Calendar $event) :Response
    {
        return  $this->render('admin/event/show.html.twig', [
            'event' => $event,
        ]);
    }
}
