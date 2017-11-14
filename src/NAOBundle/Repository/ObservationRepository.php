<?php
/**
 * Created by PhpStorm.
 * User: Emmanuel
 * Date: 11/11/2017
 * Time: 08:15
 */

namespace NAOBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ObservationRepository extends EntityRepository
{
    public function getCompleteObs()
    {
        $qb = $this
            ->createQueryBuilder('o')
            ->leftJoin('o.bird', 'bird')
            ->addSelect('bird')
            ->innerJoin('o.photos','photos')
            ->addSelect('photos')
            ->leftJoin('o.user', 'user')
            ->addSelect('user')
            ->setFirstResult(1)
            ->setMaxResults(4)
            ->getQuery()
            ->getResult()
            ;
        return $qb;
    }



}