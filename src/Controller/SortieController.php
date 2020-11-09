<?php

namespace App\Controller;

use App\Entity\Sortie;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SortieController extends AbstractController
{
    /**
     * @Route("/", name="sortie")
     */
    public function home(): Response
    {
        $sortieRepo = $this->getDoctrine()->getRepository(Sortie::class);
        $sorties = $sortieRepo ->  findAll();

        return $this->render('sortie/SortieAcceuil.html.twig', [
            "sorties" => $sorties
        ]);
    }

    public function filter($sortieRepository, $form, $inscrit, $data) {

        $sortieRepo = $sortieRepository->filter($data, $inscrit);
        return $this->render('sortie/SortieAcceuil.html.twig', [
            'sorties' => $sortieRepo,
            'inscrit' =>$inscrit,
            'form' => $form->createView(),
        ]);
    }

}
