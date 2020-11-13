<?php

namespace App\Repository;

use App\Entity\Sortie;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


/**
 * @method Sortie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sortie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sortie[]    findAll()
 * @method Sortie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SortieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sortie::class);
    }


    public function filter($search, $user)
    {
        $query = $this
            ->createQueryBuilder('s')
            ->addSelect('s')
            ->leftJoin('s.organisateur', 'o')
            ->addSelect('o')
            ->leftJoin('s.siteOrganisateur', 'c')
            ->addSelect('c')
            ->leftJoin('s.inscrits','p')
            ->addSelect('p');
        $query
            ->andWhere('s.dateHeureDebut > DATE_SUB(:dateNow,1 ,\'month\')')
            ->setParameter('dateNow', new DateTime('now'));


        if ($search->getCampus()) {
            $query
                ->andWhere('c = :campus')
                ->setParameter('campus', $search->getCampus());
        }
        if ($search->getName()) {
            $query
                ->andWhere('s.nom LIKE :name')
                ->setParameter('name', '%' . $search->getName() . '%');
        }
        if ($search->getDateMax()) {
            $query
                ->andWhere('s.dateHeureDebut > :from')
                ->setParameter('from', $search->getDateMax());
        }
        if ($search->getDateMin()) {
            $query
                ->andWhere('s.dateHeureDebut < :to')
                ->setParameter('to', $search->getDateMin());
        }
        if ($search->isOrganisateur()) {
            $query
                ->andWhere('o = :val')
                ->setParameter('val', $user);
        }
        if ($search->isInscrit()) {
            $query
                ->andWhere('p.id = :val')
                ->setParameter('val', $user);
        }
        if ($search->isNoInscrit()) {
            $query
                ->andWhere('p.id != :val')
                ->setParameter('val', $user );
        }
        if ($search->isPast()) {
            $query
                ->andWhere('s.dateHeureDebut < :dateNow')
                ->setParameter('dateNow', new DateTime('now'));
        }
        return $query->getQuery()->getResult();
    }

}

/*
public function findOneBySomeField($value): ?Sortie
{
    return $this->createQueryBuilder('s')
        ->andWhere('s.exampleField = :val')
        ->setParameter('val', $value)
        ->getQuery()
        ->getOneOrNullResult()
    ;
}
*/

