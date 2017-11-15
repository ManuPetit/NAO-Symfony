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

class ObservationRepository extends EntityRepository
{
    public function getLastObservations($limit = 4)
    {
        $qb = $this
            ->createQueryBuilder('o')
            ->leftJoin('o.bird', 'bird')
            ->addSelect('bird')
            ->leftJoin('o.photos','photos')
            ->addSelect('photos')
            ->leftJoin('o.user', 'user')
            ->addSelect('user')
            ->orderBy('o.date', 'DESC')
            ->setFirstResult(0)
            ->setMaxResults($limit);
        return new Paginator($qb);
    }

}