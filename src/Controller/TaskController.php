<?php

namespace App\Controller;

use App\Entity\Board;
use App\Entity\Category;
use App\Entity\Owner;
use App\Entity\Task;
use App\Form\TaskType;
use DateTime;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TaskController extends AbstractController
{
    /**
     * @Route("/{id}/create-task", name="task")
     *
     * @param Board $board
     * @param Request $request
     * @return Response
     */
    public function new(Board $board, Request $request): Response
    {
        // creates a new_task object and initializes some data for this example
        $task = new Task();

        $form = $this->createForm(TaskType::class, $task);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();
            $task->setBoard($board);
            $em = $this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();
            $this->addFlash('success', 'Task created');
            return $this->redirectToRoute('showBoard', ['id' => $task->getBoard()->getId()]);
        }

        return $this->render('new_task/new.html.twig', [
            'form' => $form->createView(),
            'boardID' => $board->getId(),

        ]);
    }

    /**
     * @param Request $request
     * @param Task $task
     * @return Response
     * @Route("/edit-task/{id}", name="EditTask")
     */
    public function editTask(Request $request, Task $task): Response
    {
        $form = $this->createForm(TaskType::class, $task);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Task edited');

            return $this->redirectToRoute('showBoard', ['id' => $task->getBoard()->getId()]);

        }

        return $this->render('edit_task/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

}
