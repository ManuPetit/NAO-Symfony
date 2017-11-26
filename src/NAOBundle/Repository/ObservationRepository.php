<?php
/**
 * Created by PhpStorm.
 * User: Emmanuel
 * Date: 11/11/2017
 * Time: 08:15
 */

namespace NAOBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use UserBundle\Entity\User;

class ObservationRepository extends EntityRepository
{
    public function getLastObservations($first = 0, $limit = 4)
    {
        $qb = $this
            ->createQueryBuilder('o')
            ->leftJoin('o.bird', 'bird')
            ->addSelect('bird')
            ->LeftJoin('o.photos','photos')
            ->addSelect('photos')
            ->leftJoin('o.user', 'user')
            ->addSelect('user')
            ->orderBy('o.date', 'DESC')
            ->setFirstResult($first)
            ->setMaxResults($limit);
        return new Paginator($qb);
    }

    public function getObservationsPerUser(User $user)
    {
        $masqued = 'Masqué';
        $deleted = 'Supprimé';
        return $this->createQueryBuilder('o')
            ->andWhere('o.user = :user')
            ->setParameter('user', $user)
            ->leftJoin('o.mainStatus', 's')
            ->addSelect('s')
            ->andWhere('s.name <> :name_masqued')
            ->setParameter('name_masqued', $masqued)
            ->andWhere('s.name <> :name_deleted')
            ->setParameter('name_deleted', $deleted)
            ->getQuery()
            ->getResult();
    }

    public function getAllObservations()
    {
        $deleted = 'Supprimé';
        $notready = 'Brouillon';
        return $this->createQueryBuilder('o')
            ->leftJoin('o.mainStatus', 's')
            ->addSelect('s')
            ->andWhere('s.name <> :name_deleted')
            ->setParameter('name_deleted', $deleted)
            ->andWhere('s.name <> :name_not_ready')
            ->setParameter('name_not_ready', $notready)
            ->orderBy('s.id')
            ->getQuery()
            ->getResult();
    }

    public function searchObs($frenchName,$family)
    {
        return $qb = $this
            ->createQueryBuilder('o')
            ->leftJoin('o.bird', 'b')
            ->addSelect('b')
            ->andWhere('b.frenchName = :frenchName')
            ->setParameter('frenchName', $frenchName)
            ->leftJoin('b.family', 'f')
            ->addSelect('f')
            ->andWhere('f.name = :family')
            ->setParameter('family', $family)
            ->leftJoin('o.user', 'u')
            ->addSelect('u')
            ->orderBy('o.date', 'DESC')
            ->getQuery()
            ->getResult();

        //return new Paginator($qb);
    }

}