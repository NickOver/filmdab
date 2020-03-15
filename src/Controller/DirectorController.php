<?php
/**
 * Created by PhpStorm.
 * User: Piotr
 * Date: 15.03.2020
 * Time: 15:42
 */

namespace App\Controller;


use App\Entity\Director;
use App\Form\Type\DirectorType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DirectorController extends AbstractController
{
    /**
     * @Route("/director/create", name="director_create")
     */
    public function create(Request $request)
    {
        $director = new Director();
        $form = $this->createForm(DirectorType::class, $director);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $director = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($director);
            $entityManager->flush();

            $this->addFlash(
                'info',
                'messages.info.director_created'
            );
            return $this->redirectToRoute('homepage');
        }

        return $this->render('director/add_form.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}