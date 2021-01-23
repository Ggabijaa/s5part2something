<?php

namespace App\Controller;

use App\Entity\Board;
use App\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomePageController extends AbstractController
{
    /**
     * @Route("/boards", name="home_page")
     */
    public function showBoards()
    {
        $repository = $this->getDoctrine()->getRepository(Board::class);
        $boards = $repository->findAll();
        return $this->render('home_page/boards.html.twig', [
            'boards' => $boards,
        ]);
    }
}
