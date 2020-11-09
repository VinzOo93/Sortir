<?php

namespace App\Controller;

use App\Entity\Sortie;
use App\Entity\User;
use App\Form\RegistrationFormType;
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
        $sorties = new Sortie();
        $inscrit = new User();
        $form =  $this->createForm(RegistrationFormType::class, $sorties);
        $form->handleRequest($request);

            $sortiesRepo = $sortieRepository->filter($sorties, $inscrit);

        return $this->render('sortie/SortieAcceuil.html.twig', [
                'sorties' => $sorties,
                'inscrit' =>$inscrit,
                'SortieFilterType' => $form->createView()
        ]);
    }


}
