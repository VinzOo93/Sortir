<?php

namespace App\Repository;

use App\Entity\Sortie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
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


    public function filter($data, $inscrit)
    {
        $query = $this
            ->createQueryBuilder('s')
            ->select('o', 's', 'c', 'p')
            ->leftJoin('s.organisateur', 'o')
            ->leftJoin('s.siteOrganisateur', 'c')
            ->leftJoin('s.inscrit', 'p')
            ->andWhere("DATE_ADD(DATE_ADD(s.dateHeureDebut, s.duree, 'minute'),1, 'month' -> CURRENT_TIMESTAMP()");;
        if (!empty($search->campus)) {
            $query = $query
                ->andWhere('c.id = :val')
                ->setParameter('val', $search->campus);

        }
        if (!empty($search->q)) {
            $query = $query
                ->andWhere('s.nom LIKE :q')
                ->setParameter('q', "%{$search->q}");
        }
        if (!empty($search->d)) {
            $query = $query
                ->andWhere('s.dateHeureDebut BETWEEN :from AND :to')
                ->setParameter('from', $search->dateHeureDebut)
                ->setParameter('to', $search->to);
        }
        if (!empty($search->o)) {
            $query = $query
                ->select('o LIKE app.user.id');
        }
        if (!empty($search->p)) {
            $query = $query
                ->select('p LIKE app.user.id');
        }
        if (!empty($search)) {
            $query = $query
                ->select('p NOT LIKE app.user.id');
        }
        if (!empty($search->s)) {
            $query = $query
                ->select('s.dateHeureDebut < NOW');
        }
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

