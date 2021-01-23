<?php


namespace App\Controller;


use App\Entity\Board;
use App\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BoardController extends AbstractController
{

    /**
     * @Route("/boards/{id}")
     */
    public function showBoard()
    {
        $repository = $this->getDoctrine()->getRepository(Task::class);
        //$repository = $this->getDoctrine()->getRepository(Board::class);
       // $board = $repository->find($id);
      //  $tasks = $board->getTasks();
        $tasks = $repository->findAll();
        return $this->render('boards/show.html.twig', [
            'tasks' => $tasks,
        ]);
        //return new Response(sprintf('bus "%s"', $name));
    }
}









