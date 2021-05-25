<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Anecdote;
use App\Form\AnecdoteType;
use App\Repository\AnecdoteRepository;



class AnecdoteController extends AbstractController
{
    /**
     * @Route("/anecdote", name="anecdote")
     */
    public function index(AnecdoteRepository $repo): Response
    {


        $anecdotes = $repo->findAll();

        return $this->render('anecdote/index.html.twig', [
            'controller_name' => 'AnecdoteController',
            'anecdotes' => $anecdotes
        ]);
    }

    /**
     * @Route("/", name="home")
     */
    public function home(): Response
    {
        return $this->render('anecdote/home.html.twig', [
            'title => "bienvenue'

        ]);
    }

    /**
     * @Route("/anecdote/new", name="anecdote_create")
     * @Route("/anecdote/{id}/edit", name="anecdote_edit")
     */
    public function form(Anecdote $anecdote = null,Request $request, EntityManagerInterface $manager): Response
    {
         // Si le Anecdote est différente de null alors on instancier la class Anecdote 
        if (!$anecdote) {
            $anecdote = new Anecdote();
        }


        // $anecdote = new Anecdote();
        $form = $this->createForm(AnecdoteType::class, $anecdote);

        $form->handleRequest($request);
        
        // dd($request);
        $dateEurope = new \DateTimeZone('Europe/paris');

        if ($form->isSubmitted() && $form->isValid()) {

            $anecdote->setCreatedAt(new \DateTime('now',$dateEurope));
            $manager->persist($anecdote);
            $manager->flush();

            return $this->redirectToRoute('anecdote_show', ['id' => $anecdote->getId()]);
        }



        return $this->render('anecdote/create.html.twig', [
            'formAnecdote' => $form->createView(),
            'editMode' => $anecdote->getId() !== null

        ]);
    }

    /**
     * @Route("/anecdote/{id}", name="anecdote_show")
     */
    public function show(Anecdote $anecdote): Response
    {


        return $this->render('anecdote/show.html.twig', [
            'anecdote' => $anecdote


        ]);
    }

    
}
