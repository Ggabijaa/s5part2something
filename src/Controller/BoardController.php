<?php


namespace App\Controller;


use App\Entity\Board;
use App\Entity\Task;
use App\Form\BoardType;
use App\Form\EditBoardType;
use App\Repository\BoardRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BoardController extends AbstractController
{

    /**
     * @Route("/board/{id}", name="showBoard")
     * @param int $id
     * @param BoardRepository $boardRepository
     * @return Response
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

    /**
     * @param Request $request
     * @param Board $board
     * @return Response
     * @Route("/edit-board/{id}", name="editBoard")
     */
    public function editBoard(Request $request, Board $board): Response
    {
        $form = $this->createForm(EditBoardType::class, $board);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Board edited');

            return $this->redirectToRoute('showBoard', ['id' => $board->getId()]);

        }

        return $this->render('edit_board/show.html.twig', [
            'form' => $form->createView()
        ]);
    }
}









