<?php
/**
 * Created by PhpStorm.
 * User: Emmanuel
 * Date: 10/11/2017
 * Time: 16:14
 */

namespace NAOBundle\Repository;

use Doctrine\ORM\EntityRepository;

class BirdRepository extends EntityRepository
{
    public function getLikeQueryBuilder($pattern)
    {
        return $this
            ->createQueryBuilder('b')
            ->where('b.frenchName LIKE :pattern')
            ->setParameter('pattern', $pattern)
            ;
    }
}