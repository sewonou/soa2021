<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminUserController extends AbstractController
{
    private $manager;
    private $userRepository;

    public function __construct(EntityManagerInterface $manager, UserRepository $userRepository)
    {
        $this->manager = $manager;
        $this->userRepository = $userRepository;
    }

    /**
     * @Route("/admin/users", name="admin_user")
     */
    public function index(): Response
    {
        return $this->render('admin/user/index.html.twig', [

        ]);
    }

    /**
     * @Route("/admin/users/add", name="admin_add")
     * @param Request $request
     * @param UserPasswordEncoderInterface $encoder
     * @return Response
     */

    public function create(Request $request, UserPasswordEncoderInterface $encoder):Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->addFlash('adminsuccess', "L'utilisateur à bien été ajouté");
            $hash = $encoder->encodePassword($user, $user->getHash());
            $user->setHash($hash);
            $this->manager->persist($user);
            $this->manager->flush();
            return $this->redirectToRoute('admin_user');

        }

        return $this->render('admin/user/form.html.twig', [
            'form'=> $form->createView()
        ]);
    }

    public function edit():Response
    {

    }

    public function delete():Response
    {

    }
}
