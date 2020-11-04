<?php

namespace App\DataFixtures;

use App\Entity\Sortie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class AppFixtures extends Fixture
{
    const NOM = ['aller à la place', 'aller faire du cheval', 'faire du snow bord', 'boire de bières', 'ceuillir des cerises', 'manger des abricots'];
    const DUREE = [90,60,30,240,70,150];
    const NBMAX = [5,54,12,50,30,15];
    const INFOS = ['Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla eleifend, libero in ullamcorper blandit, eros magna commodo ligula, eu fermentum eros urna posuere leo. Mauris semper purus et purus faucibus.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla eleifend, libero in ullamcorper blandit, eros magna commodo ligula, eu fermentum eros urna posuere leo. Mauris semper purus et purus faucibus.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla eleifend, libero in ullamcorper blandit, eros magna commodo ligula, eu fermentum eros urna posuere leo. Mauris semper purus et purus faucibus.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla eleifend, libero in ullamcorper blandit, eros magna commodo ligula, eu fermentum eros urna posuere leo. Mauris semper purus et purus faucibus.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla eleifend, libero in ullamcorper blandit, eros magna commodo ligula, eu fermentum eros urna posuere leo. Mauris semper purus et purus faucibus.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla eleifend, libero in ullamcorper blandit, eros magna commodo ligula, eu fermentum eros urna posuere leo. Mauris semper purus et purus faucibus.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla eleifend, libero in ullamcorper blandit, eros magna commodo ligula, eu fermentum eros urna posuere leo. Mauris semper purus et purus faucibus.'];
    const ETAT = [4,1,5,3,2,2];

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 5; $i++) {
            $sortie = new  Sortie();
            $sortie->setNom(self::NOM[$i]);
            $sortie->setDateHeureDebut(new \DateTime('now'), date_interval_create_from_date_string('+ 61 days'));
            $sortie->setDuree(self::DUREE[$i]);
            $sortie->setNbInscriptionMax(self::NBMAX[$i]);
            $sortie->setDateLimiteInscription(new \DateTime('now'), date_interval_create_from_date_string('+ 90 days'));
            $sortie->setInfosSortie(self::INFOS[$i]);
            $sortie->setEtat(self::ETAT[$i]);
            $manager->persist($sortie);
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
