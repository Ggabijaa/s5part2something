<?php


namespace App\Controller;


use App\Entity\Board;
use App\Entity\Task;
use App\Repository\BoardRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BoardController extends AbstractController
{

    /**
     * @Route("/board/{id}")
     */
    public function showBoard(int $id, BoardRepository $boardRepository)
    {
        $board = $boardRepository->findOneBy(['id' => $id ]);

        return $this->render('tasks/show.html.twig', [
            'board' => $board,
        ]);
    }
}









