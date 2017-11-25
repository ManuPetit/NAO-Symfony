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
            ->LeftJoin('o.photos', 'photos')
            ->addSelect('photos')
            ->leftJoin('o.user', 'user')
            ->addSelect('user')
            ->orderBy('o.date', 'DESC')
            ->setFirstResult($first)
            ->setMaxResults($limit);
        return new Paginator($qb);
    }

    /**
     * Function to retrieve all observations from a user
     * @param User $user
     * @return array
     */
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

    /**Function to retrieve all observations (except the one deleted or not put
     * in for validation(status brouillon)) or to retrieve all observation from
     * a filtered status
     * @param null $filter
     * @return array
     */
    public function getAllObservations($filter = null)
    {
        if (isset($filter) && $filter != '') {
            $qb = $this->createQueryBuilder('o')
                ->leftJoin('o.mainStatus', 's')
                ->addSelect('s')
                ->andWhere('s.id = :filter')
                ->setParameter('filter', $filter)
                ->orderBy('o.id')
                ->getQuery()
                ->getResult();
        } else {
            $deleted = 'Supprimé';
            $not_ready = 'Brouillon';
            $qb = $this->createQueryBuilder('o')
                ->leftJoin('o.mainStatus', 's')
                ->addSelect('s')
                ->andWhere('s.name <> :name_deleted')
                ->setParameter('name_deleted', $deleted)
                ->andWhere('s.name <> :name_not_ready')
                ->setParameter('name_not_ready', $not_ready)
                ->orderBy('s.id')
                ->getQuery()
                ->getResult();
        }
        return $qb;
    }

    public function getObservationBySearch($search)
    {
        $deleted = 'Supprimé';
        $not_ready = 'Brouillon';
        return $this->createQueryBuilder('o')
            ->andWhere('LOWER(o.title) LIKE LOWER(:search)')
            ->setParameter('search', '%' . $search . '%')
            ->leftJoin('o.mainStatus', 's')
            ->addSelect('s')
            ->andWhere('s.name <> :name_deleted')
            ->setParameter('name_deleted', $deleted)
            ->andWhere('s.name <> :name_not_ready')
            ->setParameter('name_not_ready', $not_ready)
            ->orderBy('s.id')
            ->getQuery()
            ->getResult();
    }
}