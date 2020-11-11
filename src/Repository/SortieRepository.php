<?php

namespace App\Repository;

use App\Entity\FilterSortie;
use App\Entity\Sortie;
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


    public function filter(FilterSortie $search, $user)
    {
        $query = $this
            ->createQueryBuilder('s')
            ->leftJoin('s.organisateur', 'o')
            ->leftJoin('s.siteOrganisateur', 'c')
            ->leftJoin('s.inscrits', 'p')
            ->select('o', 's', 'c', 'p')
           // ->andWhere("DATE_ADD(DATE_ADD(s.dateHeureDebut, s.duree, 'minute'),1, 'month' > CURRENT_TIMESTAMP()")
        ;
    /*    if (!empty($search->siteOrganisateur)) {
            $query = $query
                ->andWhere('c.id = :val')
                ->setParameter('val', $search->siteOrganisateur);

        }
        if (!empty($search->q)) {
            $query = $query
                ->andWhere('s.nom LIKE :name')
                ->setParameter('name', "%{$search->q}");
        }
        if (!empty($search->d)) {
            $query = $query
                ->andWhere('s.dateHeureDebut = :from')
                ->setParameter('from', $search->d);
        }
        if (!empty($search->d)){
            $query =$query
                ->andWhere('s.dateHeureDebut = :to')
                ->setParameter('to', $search->d);
        }
        if (!empty($search->o)) {
            $query = $query
                ->andWhere('o = :val')
                ->setParameter('val', $user);
        }
        if (!empty($search->p)) {
            $query = $query
                ->andWhere('p = :val')
                ->setParameter('val', $user);
        }
        if (!empty($search->p)) {
            $query = $query
            ->andWhere('p != :val')
            ->setParameter('val', $user);
        }
        if (!empty($search->s)) {
            $query = $query
                ->andWhere('s.dateHeureDebut < :now');

        }
    */    return $query->getQuery()->getResult();
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

