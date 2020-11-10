<?php

namespace App\Controller;

use App\Entity\Campus;
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
        $campusrepo = $this->getDoctrine()->getRepository(Campus::class);
        $campus = $campusrepo ->findAll();
        $data = new FilterSortie();
        $form =  $this->createForm(SortieFilterType::class, $data, $campus);
        $form->handleRequest($request);
        $sortiesRepo = $sortieRepository->filter($data, $user);

      return $this->render('sortie/SortieAcceuil.html.twig', [
                'sorties' => $sortiesRepo,
                'user' =>$user,
                'SortieFilterType' => $form->createView()
        ]);
    }


}
