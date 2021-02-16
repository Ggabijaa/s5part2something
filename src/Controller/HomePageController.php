<?php

namespace App\Controller;

use App\Entity\Board;
use App\Entity\Task;
use App\Repository\BoardRepository;
use App\Repository\OwnerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomePageController extends AbstractController
{
    /**
     * @Route("/{userId}/boards", name="home_page")
     */
    public function showBoard(int $userId, BoardRepository $boardRepository, OwnerRepository $ownerRepository)
    {
        $board = $boardRepository->findBy( ['id' => $userId]);
        $owner = $ownerRepository->findOneBy(['id' => $userId]);

        $owner->getName();
        return $this->render('home_page/boards.html.twig', [
            'boards' => $board,
            'users' => $owner
        ]);
    }
}
