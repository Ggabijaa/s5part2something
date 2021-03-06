<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
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
     * @param Request $request
     * @return Response
     */
    public function new(Request $request, CategoryRepository $categoryRepository): Response
    {

        // creates a new_task object and initializes some data for this example
        $category = new Category();

        $form = $this->createForm(CategoryType::class, $category);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $category = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();
            $this->addFlash('success', 'Category created');
            return $this->redirect('/create-category');
        }

        $categories = $categoryRepository->findAll();

        return $this->render('category/new.html.twig', [
            'form' => $form->createView(),
            'categories' => $categories,
        ]);
    }

    /**
     * @param Request $request
     * @param Category $category
     * @param CategoryRepository $categoryRepository
     * @return Response
     * @Route("/edit-category/{id}", name="EditCategory")
     */
    public function editCategory(Request $request, Category $category, CategoryRepository $categoryRepository): Response
    {
        $form = $this->createForm(CategoryType::class, $category);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Task edited');

            return $this->redirect('/create-category');

        }

        return $this->render('category/new.html.twig', [
            'form' => $form->createView(),
            'categories' => $categoryRepository->findAll()
        ]);
    }

    /**
     * @param Category $category
     * @return Response
     * @Route("/delete-category/{id}", name="deleteCategory")
     */
    public function removeCategory(Category $category)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($category);
        $em->flush();
        $this->addFlash('success', 'Category removed');
        return $this->redirect('/create-category');
    }
}
