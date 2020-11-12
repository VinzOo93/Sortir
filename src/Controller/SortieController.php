<?php

namespace App\Controller;

use App\Entity\AddSortie;

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

        $user= $this->getUser();
        $filtreSortie = new FilterSortie($user->getCampus());
        $form =  $this->createForm(SortieFilterType::class, $filtreSortie);
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
    public function addSortie(EntityManagerInterface $em, Request $request)  {

        $villeRepo = $this->getDoctrine()->getRepository(Ville::class);
        $lieuRepo = $this->getDoctrine()->getRepository(Lieu::class);
        $ville = $villeRepo->findAll();
        $lieu = $lieuRepo->findAll();


        $user= $this->getUser();
        $sortie = new Sortie();
        $l = new Lieu();
        $v = new Ville();
        $sortieForm = new AddSortie($sortie->getLieu(), $l->getVille());
        $form = $this->createForm(SortieType::class, $sortieForm);
        $form->handleRequest($request);






        if ($form->isSubmitted()) {

            $sortie->setOrganisateur($user->getId());
            $sortie->addInscrit($user->getId());
            $sortie->setEtat(146);

            $em->persist($sortie);
            $em->persist($l);
            $em->persist($v);

            $em->flush();

            $this->addFlash('success', 'Votre évènement de sortie est enregistré !!');

        }



        return $this->render('sortie/SortieType.html.twig', [
                "sortie_type" => $form->createView(),
                "lieu" => $lieu,
                "ville" => $ville,
            ]);

    }


}
