<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/create-category", name="category")
     */
    public function new(Request $request): Response
    {
        // creates a task object and initializes some data for this example
        $category = new Category();
        $form = $this->createFormBuilder($category)
            ->add('name', TextType::class)
            ->add('save', SubmitType::class, ['label' => 'Create Task'])
            ->getForm();

        $form = $this->createForm(CategoryType::class, $category);

        return $this->render('category/new.html.twig', [
            'form' =>$form->createView(),
        ]);

        $form = handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $category = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();
        }

        return $this->render('category/new.html.twig',[
            'form'=>$form->createView()
        ]);
    }
}
