<?php

namespace App\Controller;

use App\Entity\AddSortie;

use App\Entity\Etat;
use App\Entity\FilterSortie;
use App\Entity\Sortie;
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
        $this->denyAccessUnlessGranted("ROLE_USER");

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
        $this->denyAccessUnlessGranted("ROLE_USER");

        $publie = 146;
        $etatRepo = $this->getDoctrine()->getRepository(Etat::class);


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

            return $this->render('sortie/SortieDetail.html.twig', [
                "sortie" => $sortie
            ]);
        }


        return $this->render('sortie/SortieType.html.twig', [
            "sortie_type" => $form->createView(),
        ]);

    }

    /**
     * @Route ("/sortie_detail/{id}", name="sortie_detail",
     *        requirements={"id":"\d+"},
     *        methods={"GET"})
     * @param $id
     * @return Response
     */
    public function detail($id)
    {
        $this->denyAccessUnlessGranted("ROLE_USER");

        $sortieRepo = $this->getDoctrine()->getRepository(Sortie::Class);
        $sortie = $sortieRepo->find($id);
        return $this->render('sortie/SortieDetail.html.twig', [
            "sortie" => $sortie
        ]);
    }

}
