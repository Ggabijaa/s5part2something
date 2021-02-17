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
        $board = $boardRepository->findOneBy(['id' => $id]);

        return $this->render('tasks/show.html.twig', [
            'board' => $board,
        ]);
    }

    /**
     * @param Task $task
     * @Route("/delete-task/{id}", name="deleteTask")
     */
    public function removeTask(Task $task)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($task);
        $em->flush();
        $boardID = $task->getBoard();
        $this->addFlash('success', 'Task removed');
        return $this->render('tasks/show.html.twig', [
            'board' => $boardID,
        ]);//kaip nrml redirectint
    }



}









