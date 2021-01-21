<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BoardController extends AbstractController
{
    /**
     * @return Response
     * @Route("/")
     */
    public function home()
    {
        return new Response('dadam');
    }

    /**
     * @Route("/boards/{name}")
     */
    public function showBoard($name)
    {

        $tasks = [
            'task 1', 'task 2', 'task 3'
        ];

        return $this->render('boards/show.html.twig', [
            'tasks' => $tasks,
            'boardName' => ucwords(str_replace('-', ' ', $name))
        ]);
        //return new Response(sprintf('bus "%s"', $name));
    }
}









