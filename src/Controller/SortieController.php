<?php

namespace App\Controller;

use App\Entity\Sortie;
use App\Form\SortieFilterType;
use App\Repository\SortieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SortieController extends AbstractController
{
    /**
     * @Route("/", name="sortie")
     * @param SortieRepository $sortieRepository
     * @param Request $request
     * @return Response
     */
    public function home(SortieRepository $sortieRepository, Request $request): Response
    {
        $sortie = new Sortie();
        $form =  $this->createForm(SortieFilterType::class, $sortie);
        $form->handleRequest($request);
        $inscrit = $this -> getUser();
        $sortiesRepo = $sortieRepository->filter($sortie, $inscrit);

        return $this->render('sortie/SortieAcceuil.html.twig', [
                'sorties' => $sortiesRepo,
                'inscrit' =>$inscrit,
                'SortieFilterType' => $form->createView()
        ]);
    }


}
