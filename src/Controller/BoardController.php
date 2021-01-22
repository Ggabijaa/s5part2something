<?php


namespace App\Controller;


use App\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BoardController extends AbstractController
{
    /**
     * @return Response
     * @Route("/", name="homepage")
     */
    public function home()
    {

        return new Response('dadam');
    }

    /**
     * @Route("/boards/{name}")
     */
    public function showBoard($name)
    {
        $repository = $this->getDoctrine()->getRepository(Task::class);
        $tasks = $repository->findAll();

        return $this->render('boards/show.html.twig', [
            'tasks' => $tasks,
            'boardName' => ucwords(str_replace('-', ' ', $name))
        ]);
        //return new Response(sprintf('bus "%s"', $name));
    }
}









