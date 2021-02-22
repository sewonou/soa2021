<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminCategoryController extends AbstractController
{
    private $manager;
    private $categoryRepository;

    public function __construct(EntityManagerInterface $manager, CategoryRepository $categoryRepository)
    {
        $this->manager = $manager;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @Route("/admin/category", name="admin_category")
     */
    public function index(): Response {
        $categories = $this->categoryRepository->findAll();
        return $this->render('admin/category/index.html.twig', [
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("/admin/category/new", name="admin_category_create")
     * @param Request $request
     * @return Response
     */
    public function create(Request $request):Response
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->addFlash(
                'adminsuccess',
                "La catégorie à bien été ajouter avec succès"
            );
            $this->manager->persist($category);
            $this->manager->flush();
            return $this->redirectToRoute('admin_category');
        }
        return $this->render('admin/category/form.html.twig', [
            'form'=> $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/category/{id}/edit", name="admin_category_edit")
     * @param Request $request
     * @param Category $category
     * @return Response
     */
    public function edit(Request $request, Category $category):Response
    {
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->addFlash(
                'adminsuccess',
                "La catégorie à bien été modifier avec succès"
            );
            $this->manager->persist($category);
            $this->manager->flush();
            return $this->redirectToRoute('admin_category');
        }
        return $this->render('admin/category/form.html.twig', [
            'form'=> $form->createView(),
            'category' => $category,
        ]);
    }

    /**
     * @Route("/admin/category/{id}/delete", name="admin_category_delete")
     * @param Category $category
     * @return Response
     */
    public function delete(Category $category):Response
    {
        $this->manager->remove($category);
        $this->manager->flush();
        $this->addFlash(
            'success',
            "La catégorie a bien été supprimer"
        );
        return $this->redirectToRoute('admin_category');
    }
}
