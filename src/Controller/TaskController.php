<?php

namespace App\Controller;

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
     * @Route("/create-task", name="task")
     *
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        // creates a task object and initializes some data for this example
        $task = new Task();

        $form = $this->createForm(TaskType::class, $task);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();

            return $this->redirect('/');
        }

        return $this->render('task/new.html.twig', [
            'form' => $form->createView(),

        ]);
    }

}
