<?php

namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HelloController extends AbstractController
{

    private array $messages = ['0', 'abc', '1'];


    #[Route(path: "/{limit<\d+>?3}", name: "app_index")]
    public function index(int $limit): Response
    {
        //return new Response(implode(" ", array_slice($this->messages, 0, $limit)));
        return $this->render("hello/index.html.twig",
        [
            'messages' => $this->messages,
            'limit'=> $limit
        ]
        );
    }

    #[Route(path: "/messages/{id<\d+>?0}", name: "app_show_one")]
    public function showOne(int $id): Response
    {
        return $this->render(
            'hello/show_one.html.twig',
            [
                'messages' => $this->messages[$id],
            ]
        );

        //return new Response(($this->messages[$id]));
    }
}
