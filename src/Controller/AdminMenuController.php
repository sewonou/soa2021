<?php

namespace App\Controller;

use App\Entity\Menu;
use App\Form\MenuType;
use App\Repository\MenuRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminMenuController extends AbstractController
{
    private $manager;
    private $menuRepository;


    public function __construct(EntityManagerInterface $manager, MenuRepository $menuRepository)
    {
        $this->manager = $manager;
        $this->menuRepository = $menuRepository;
    }

    /**
     * @Route("/admin/menu", name="admin_menu")
     */
    public function index(): Response
    {
        $menus = $this->menuRepository->findAll();

        return $this->render('admin/menu/index.html.twig', [
            'menus' => $menus,
        ]);
    }

    /**
     * @Route("/admin/menu/create", name="admin_menu_create")
     * @param Request $request
     * @return Response
     */
    public function create(Request $request):Response
    {
        $menu = new Menu();
        $form = $this->createForm(MenuType::class, $menu);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->addFlash('adminsuccess', "Le menu a été ajouter avec succès");
            $this->manager->persist($menu);
            $this->manager->flush();
            return $this->redirectToRoute('admin_menu');
        }

        return $this->render('admin/menu/form.html.twig', [
            'form'=> $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/menu/{id}", name="admin_menu_edit")
     * @param Menu $menu
     * @param Request $request
     * @return Response
     */
    public function edit(Menu $menu, Request $request): Response
    {
        $form = $this->createForm(MenuType::class, $menu);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->addFlash('adminsuccess', "Le menu a été ajouter avec succès");
            $this->manager->persist($menu);
            $this->manager->flush();
            return $this->redirectToRoute('admin_menu');
        }

        return $this->render('admin/menu/form.html.twig', [
            'form'=> $form->createView(),
            'menu'=> $menu
        ]);
    }

    /**
     * @Route("/admin/menu/{id}/delete}", name="admin_menu_delete")
     * @param Menu $menu
     * @return Response
     */
    public function delete(Menu $menu): Response
    {
        $this->manager->remove($menu);
        $this->manager->flush();
        $this->addFlash(
            'adminsuccess',
            "Le menu a bien été supprimer"
        );
        return $this->redirectToRoute('admin_menu');
    }
}
