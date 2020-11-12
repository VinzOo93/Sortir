<?php

namespace App\Controller;

use App\Entity\AddSortie;

use App\Entity\Etat;
use App\Entity\FilterSortie;
use App\Entity\Lieu;
use App\Entity\Sortie;
use App\Entity\Ville;
use App\Form\SortieFilterType;
use App\Form\SortieType;
use App\Repository\SortieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
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

        $user = $this->getUser();
        $filtreSortie = new FilterSortie($user->getCampus());
        $form = $this->createForm(SortieFilterType::class, $filtreSortie);
        $form->handleRequest($request);
        $sortiesList = $sortieRepository->filter($filtreSortie, $user);

        return $this->render('sortie/SortieAcceuil.html.twig', [
            'sorties' => $sortiesList,
            'SortieFilterType' => $form->createView()
        ]);
    }

    /**
     * @Route("/sortie_type", name="sortie_type")
     * @param EntityManagerInterface $em
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function addSortie(EntityManagerInterface $em, Request $request)
    {
        $publie = 146;
        $etatRepo = $this ->getDoctrine()->getRepository(Etat::class);


        $user = $this->getUser();
        $sortie = new Sortie();
        $form = $this->createForm(SortieType::class, $sortie);
        $form->handleRequest($request);
        $sortie->setOrganisateur($user);
        $sortie->addInscrit($user);
        $etatId = $etatRepo->find($publie);
        $sortie->setEtat($etatId);
        $sortie->setSiteOrganisateur($user->getCampus());
        if ($form->isSubmitted()) {
            $em->persist($sortie);

            $em->flush();

            $this->addFlash('success', 'Votre évènement de sortie est enregistré !!');

            return  $this ->render('sortie/SortieDetail.html.twig', [
                "sortie" => $sortie
            ]);
        }


        return $this->render('sortie/SortieType.html.twig', [
            "sortie_type" => $form->createView(),
        ]);

    }

    public function detail($id) {
        $sortieRepo = $this->getDoctrine()->getRepository(Sortie::Class);
        $sortie = $sortieRepo->find($id);
        return $this ->render('sortie/SortieDetail.html.twig', [
            "sortie" => $sortie
        ]);
    }

}
