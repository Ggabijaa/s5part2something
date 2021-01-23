<?php

namespace App\Controller;

use App\Entity\Board;
use App\Form\BoardType;
use App\Form\CategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NewBoardController extends AbstractController
{
    /**
     * @param Request $request
     * @return Response
     * @Route("/create-board", name="board")
     */
    public function new(Request $request): Response
    {

        // creates a task object and initializes some data for this example
        $board = new Board();

        $form = $this->createForm(BoardType::class, $board);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $board = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($board);
            $em->flush();

            return $this->redirect('/');
        }

        return $this->render('new_board/new.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
