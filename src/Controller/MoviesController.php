<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Form\Type\MovieType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MoviesController extends AbstractController
{
    /**
     * @Route("/movies", name="movies")
     */
    public function moviesList()
    {
        $movies = $this->getDoctrine()->getRepository(Movie::class)->findAll();

        return $this->render('movie/movies_list.html.twig', [
            'movies' => $movies,
        ]);
    }

    /**
     * @Route("/movie/create", name="movie_create")
     */
    public function create(Request $request)
    {
        $movie = new Movie();
        $form = $this->createForm(MovieType::class, $movie);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $director = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($director);
            $entityManager->flush();

            $this->addFlash(
                'info',
                'messages.info.movie_created'
            );
            return $this->redirectToRoute('movies');
        }

        return $this->render('movie/add_form.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}