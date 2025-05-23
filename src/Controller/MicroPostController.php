<?php

namespace App\Controller;

use App\Entity\MicroPost;
use App\Repository\MicroPostRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

final class MicroPostController extends AbstractController
{
    #[Route('/micro-post', name: 'app_micro_post')]
    public function index(MicroPostRepository $posts): Response
    {
        // dd($posts->find(1));
        return $this->render('micro_post/index.html.twig', [
            'posts' => $posts->findAll(),

        ]);
    }
    #[Route('micro-post/{post}', name: 'app_micro_post_show')]
    public function showOne(MicroPost $post): Response
    {
        return $this->render('micro_post/show.html.twig', [
            'post' => $post,
        ]);
    }
    #[Route('/micro-post/add', name: 'app_micro_post_add', priority: 2)]
    public function add(Request $request, MicroPostRepository $posts): Response
    {
        $microPost = new MicroPost();
        $form = $this->createFormBuilder($microPost)
            ->add('title', TextType::class)
            ->add('text', TextType::class)
            
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $post = $form->getData();
            $post->setCreated(new \DateTime());
            $posts->add($post, true);


            $this->addFlash('success', 'Post has been added');
            return $this->redirectToRoute('app_micro_post');
        }
        return $this->render(
            'micro_post/add.html.twig',
            [
                'form' => $form,
            ]
        );
    }
    #[Route('/micro-post/edit/{post<\d+>}', name:'app_micro_post_edit', priority:2)]
    public function edit(Request $request, MicroPostRepository $posts, MicroPost $post): Response
    {
        $microPost = new MicroPost();

        $form = $this->createFormBuilder($microPost)
        ->add('title', TextType::class)
        ->add('text', TextType::class)
        ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $post = $form->getData();
            $posts->add($post, true);
            $this->addFlash('success','Post has been edited');
            return $this->redirectToRoute('app_micro_post');
        }
        return $this->render('micro_post/edit.html.twig',
        [
        'posts' => $posts,
        'post' => $post->getId(),
    ]
    );
    }
}
