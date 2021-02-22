<?php

namespace App\Controller;

use App\Entity\Participant;
use App\Form\ParticipantType;
use App\Repository\ParticipantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminParticipantController extends AbstractController
{
    private $manager;
    private $participantRepository;


    public function __construct(EntityManagerInterface $manager, ParticipantRepository $participantRepository)
    {
        $this->manager = $manager;
        $this->participantRepository = $participantRepository;
    }

    /**
     * @Route("/admin/participant", name="admin_participant")
     */
    public function index(): Response
    {
        $participants = $this->participantRepository->findAll();
        return $this->render('admin/participant/index.html.twig', [
            'participants' => $participants,
        ]);
    }

    /**
     * @Route("/admin/participant/new", name="admin_participant_create")
     * @param Request $request
     * @return Response
     */
    public function create(Request $request):Response
    {
        $participant = new Participant();
        $form = $this->createForm(ParticipantType::class, $participant);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->addFlash(
                'adminsuccess',
                "Le participant a été ajouter avec succès"
            );
            $this->manager->persist($participant);
            $this->manager->flush();
            return $this->redirectToRoute('admin_participant');
        }
        return $this->render('admin/participant/form.html.twig', [
            'form'=> $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/participant/{id}/edit", name="admin_participant_edit")
     * @param Request $request
     * @param Participant $participant
     * @return Response
     */
    public function edit(Request $request, Participant $participant):Response
    {
        $form = $this->createForm(ParticipantType::class, $participant);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->addFlash(
                'adminsuccess',
                "Le participant a été modifier avec succès"
            );
            $this->manager->persist($participant);
            $this->manager->flush();

            return $this->redirectToRoute('admin_participant');
        }
        return $this->render('admin/participant/form.html.twig', [
            'form'=> $form->createView(),
            'participant' => $participant,
        ]);
    }

    /**
     * @Route("/admin/participant/{id}/delete", name="admin_participant_delete")
     * @param Participant $participant
     * @return Response
     */
    public function delete( Participant $participant):Response
    {
        $this->manager->remove($participant);
        $this->manager->flush();
        $this->addFlash(
            'success',
            "Le participant a bien été supprimer"
        );
        return $this->redirectToRoute('admin_participant');
    }

    /**
     * @Route("/admin/participant/{id}/show", name="admin_participant_show")
     * @param Participant $participant
     * @return Response
     */
    public function show(Participant $participant) :Response
    {
        return  $this->render('admin/participant/show.html.twig', [
            'participant' => $participant,
        ]);
    }
}
