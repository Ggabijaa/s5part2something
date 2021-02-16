<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Owner;
use App\Form\OwnerType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/create-user", name="user")
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        // creates a new_task object and initializes some data for this example
        $owner = new Owner();

        $form = $this->createForm(OwnerType::class, $owner);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $owner = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($owner);
            $em->flush();

            return $this->redirect('/');
        }

        return $this->render('user/new.html.twig', [
            'form' =>$form->createView(),
        ]);

    }
}
