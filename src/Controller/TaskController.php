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
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TaskController extends AbstractController
{
    /**
     * @Route("/create-task", name="task")
     */
    public function new(Request $request): Response
    {
        // creates a task object and initializes some data for this example
        $task = new Task();
        $form = $this->createFormBuilder($task)
            ->add('title', TextType::class)
            ->add('owner', IntegerType::class)
            ->add('status', ChoiceType::class, [
                'choices' => [
                    Task::STATUS_NOT_STARTED => Task::STATUS_NOT_STARTED,
                    Task::STATUS_IN_PROGRESS => Task::STATUS_IN_PROGRESS,
                    Task::STATUS_COMPLETED => Task::STATUS_COMPLETED,
                ]])
            ->add('category', IntegerType::class)
            ->add('timeSpent', DateTimeType::class)
            ->add('startDate', DateTimeType::class)
            ->add('save', SubmitType::class, ['label' => 'Create Task'])
            ->getForm();

        $form = $this->createForm(TaskType::class, $task);

        return $this->render('task/new.html.twig', [
            'form' =>$form->createView(),
    ]);

        $form = handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $task = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();
        }

        return $this->render('task/new.html.twig',[
            'form'=>$form->createView()
        ]);
    }

}
