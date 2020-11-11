<?php

namespace App\Controller;

use App\Entity\FilterSortie;
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

        $user= $this->getUser();
        $filtreSortie = new FilterSortie($user->getCampus());
        $form =  $this->createForm(SortieFilterType::class, $filtreSortie);
        $form->handleRequest($request);
        $sortiesList = $sortieRepository->filter($filtreSortie, $user);
        // $sortiesList = $sortieRepository->findAll();

      return $this->render('sortie/SortieAcceuil.html.twig', [
                'sorties' => $sortiesList,
                'SortieFilterType' => $form->createView()
        ]);
    }


}
