<?php

namespace App\DataFixtures;

use App\Entity\Sortie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class AppFixtures extends Fixture
{
    const NOM = ['aller à la place', 'aller faire du cheval', 'faire du snow bord', 'boire de bières', 'ceuillir des cerises', 'manger des abricots'];
    const DHD = ['03/10/2020 04:15:50', '26/09/2020 15:04:03', '08/10/2020 21:39:10', '12/10/2020 11:37:17', '14/09/2020 06:29:19', '31/10/2020 23:40:33'];
    const DUREE = [90,60,30,240,70,150];
    const NBMAX = [5,54,12,50,30,15];
    const DLIM = ['03/11/2020 00:00:00', '03/11/2020 00:00:00', '03/11/2020 00:00:00', '03/11/2020 00:00:00', '03/11/2020 00:00:00', '03/11/2020 00:00:00'];
    const INFOS = ['Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla eleifend, libero in ullamcorper blandit, eros magna commodo ligula, eu fermentum eros urna posuere leo. Mauris semper purus et purus faucibus.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla eleifend, libero in ullamcorper blandit, eros magna commodo ligula, eu fermentum eros urna posuere leo. Mauris semper purus et purus faucibus.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla eleifend, libero in ullamcorper blandit, eros magna commodo ligula, eu fermentum eros urna posuere leo. Mauris semper purus et purus faucibus.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla eleifend, libero in ullamcorper blandit, eros magna commodo ligula, eu fermentum eros urna posuere leo. Mauris semper purus et purus faucibus.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla eleifend, libero in ullamcorper blandit, eros magna commodo ligula, eu fermentum eros urna posuere leo. Mauris semper purus et purus faucibus.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla eleifend, libero in ullamcorper blandit, eros magna commodo ligula, eu fermentum eros urna posuere leo. Mauris semper purus et purus faucibus.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla eleifend, libero in ullamcorper blandit, eros magna commodo ligula, eu fermentum eros urna posuere leo. Mauris semper purus et purus faucibus.'];
    const ETAT = [4,1,5,3,2,2];

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 5; $i++) {
            $sortie = new  Sortie();
            $sortie->setNom(self::NOM);
            $sortie->setDateHeureDebut(self::DHD);
            $sortie->setDuree(self::DUREE);
            $sortie->setNbInscriptionMax(self::NBMAX);
            $sortie->setDateLimiteInscription(self::DLIM);
            $sortie->setInfosSortie(INFO);
            $sortie->setEtat(self::ETAT);
            $manager->persist($sortie);
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
