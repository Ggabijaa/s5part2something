<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Owner;
use App\Form\OwnerType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/create-user", name="user")
     */
    public function new(Request $request): Response
    {
        // creates a task object and initializes some data for this example
        $owner = new Owner();
        $form = $this->createFormBuilder($owner)
            ->add('name', TextType::class)
            ->add('save', SubmitType::class, ['label' => 'Create Task'])
            ->getForm();

        $form = $this->createForm(OwnerType::class, $owner);

        return $this->render('user/new.html.twig', [
            'form' =>$form->createView(),
        ]);

        $form = handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $owner = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($owner);
            $em->flush();
        }

        return $this->render('owner/new.html.twig',[
            'form'=>$form->createView()
        ]);
    }
}
