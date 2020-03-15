<?php
/**
 * Created by PhpStorm.
 * User: Piotr
 * Date: 15.03.2020
 * Time: 16:32
 */

namespace App\Controller;


use App\Entity\Genre;
use App\Form\Type\GenreType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class GenreController extends AbstractController
{
    /**
     * @Route("/genre/create", name="genre_create")
     */
    public function create(Request $request)
    {
        $genre = new Genre();
        $form = $this->createForm(GenreType::class, $genre);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $genre = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($genre);
            $entityManager->flush();

            $this->addFlash(
                'info',
                'messages.info.genre_created'
            );
            return $this->redirectToRoute('homepage');
        }

        return $this->render('genre/add_form.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}