<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminPostController extends AbstractController
{
    private $manager;
    private $postRepository;

    public function __construct(EntityManagerInterface $manager, PostRepository $postRepository)
    {
        $this->manager = $manager;
        $this->postRepository = $postRepository;
    }

    /**
     * @Route("/admin/post", name="admin_post")
     */
    public function index(): Response
    {
        $posts = $this->postRepository->findAll();
        return $this->render('admin/post/index.html.twig', [
            'posts'=> $posts,
        ]);
    }

    /**
     * @Route("/admin/post/new", name="admin_post_create")
     * @param Request $request
     * @return Response
     */
    public function create(Request $request):Response
    {
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid()){
            $this->addFlash(
                'adminsuccess',
                "L'article a été ajouter avec succès."
            );
            $this->manager->persist($post);
            $this->manager->flush();
            return $this->redirectToRoute('admin_post');
        }
        return $this->render('admin/post/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/post/{id}/edit", name="admin_post_edit")
     * @param Request $request
     * @param Post $post
     * @return Response
     */
    public function edit(Request $request, Post $post):Response
    {
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid()){
            $this->addFlash(
                'adminsuccess',
                "L'article a été ajouter avec succès."
            );
            $this->manager->persist($post);
            $this->manager->flush();
            return $this->redirectToRoute('admin_post');
        }
        return $this->render('admin/post/form.html.twig', [
            'form' => $form->createView(),
            'post'=> $post,
        ]);
    }

    /**
     * @Route("/admin/post/{id}/delete", name="admin_post_delete")
     * @param Post $post
     * @return Response
     */
    public function delete(Post $post):Response
    {
        $this->manager->remove($post);
        $this->manager->flush();
        $this->addFlash(
            'adminsuccess',
            "L' article à bien été supprimer."
        );
        return $this->redirectToRoute('admin_post');
    }
}
