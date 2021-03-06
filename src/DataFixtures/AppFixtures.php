<?php

namespace App\DataFixtures;

use App\Entity\Campus;
use App\Entity\Etat;
use App\Entity\Lieu;
use App\Entity\Sortie;
use App\Entity\User;
use App\Entity\Ville;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;



class AppFixtures extends Fixture
{


    //contatne pour Ville
    const VILLE = ['Lyon', 'Nante', 'Paris', 'Lille', 'Marseille', 'Strasbourg'];
    const CODE_POSTALE = ['69000', '44000', '75000', '59000','13000', '67000'];

    // contante pour lieu
    const LIEU = ['parc de la tête dor', 'musée histoire natuelle', 'Montmartre', 'Stadium lille metropole', 'Vieux port', 'Au perchoir'];
    const RUE = ['Rue de Chance', 'Route des Épicéas', 'Rue des Fermiers', 'Voie du Peuplier', 'Rue de lAurore', 'rue de la 1ere armée'];


    //contante pour l'objet campus
    const CAMPUS =['ENI_NANTE', 'ENI_RENNES', 'ENI_NIORT'];

    //constante pour l'objet etat
    const LIBELLE = ['créée', 'ouverte', 'cloturé' , 'activité en cours','passer', 'Annulé'];

    // contante pour l'objet Sortie
    const NOM = ['aller à la place', 'aller faire du cheval', 'faire du snow bord', 'boire des bières', 'ceuillir des cerises', 'manger des abricots'];
    const INFOS ='Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla eleifend, libero in ullamcorper blandit, eros magna commodo ligula, eu fermentum eros urna posuere leo. Mauris semper purus et purus faucibus.';

    public function load(ObjectManager $manager)
    {
        for ($v =0 ;$v <6; $v ++)
        {
            $ville = new Ville();
            $ville->setNom(self::VILLE[$v]);
            $ville->setCodePostal(self::CODE_POSTALE[$v]);


            $manager->persist($ville);
        }
        $manager->flush();

        for ($l = 0 ; $l < 6; $l ++)
        {
            $lieu = new  Lieu();
            $lieu->setNom(self::LIEU[$l]);
            $lieu->setRue(self::RUE[$l]);
            $lieu->setVille($ville);

            $manager->persist($lieu);
            $this->setReference(Ville::class, $ville );
        }
        $manager->flush();
        for ($y = 0; $y<6; $y++)
        {
            $etat = new  Etat();
            $etat->setLibelle(self::LIBELLE[$y]);

            $manager->persist($etat);
        }
        $manager->flush();
        for ($c = 0; $c < 3; $c++)
        {
            $campus = new  Campus();
            $campus->setNom(self::CAMPUS[$c]);

            $manager->persist($campus);
        }
        $manager->flush();
        for ($u = 0 ; $u <10 ; $u ++)
        {
            $user = new User();
            $user->setNom('HENNI' .$u);
            $user->setPrenom('MOMO' .$u);
            $user->setTelephone('0606060600');
            $user->setEmail('momo'.$u.'@live.fr');
            $user->setRoles(['ROLE_USER']);
            $user->setPassword('momo'.$u);
            $user->setCampus($campus,mt_rand(1,3));

            $sortie = new  Sortie();
            $manager->persist($user);
            $this->setReference(Campus::class, $campus);
            $this->setReference(Sortie::class, $sortie);



        }
        $manager->flush();
        for ($i = 0; $i < 6; $i++)
        {
            $sortie = new  Sortie();
            $sortie->setNom(self::NOM[$i]);
            $sortie->setDateHeureDebut(new DateTime('now'));
            $sortie->setDuree(mt_rand(1, 500));
            $sortie->setNbInscriptionMax(mt_rand(1, 15));
            $sortie->setDateLimiteInscription(new DateTime('2020-12-15'));
            $sortie->setInfosSortie(self::INFOS);
            $sortie->setEtat($etat, mt_rand(1,300));
            $sortie->setOrganisateur($user, mt_rand(1,300) );
            $sortie->setLieu($lieu, mt_rand(1,300));
            $sortie->setSiteOrganisateur($campus, mt_rand(1 , 300));
            $manager->persist($sortie);
            $this->setReference(Campus::class, $campus );
            $this->setReference(Etat::class, $etat );
            $this->setReference(User::class, $user );



        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();


    }



}
