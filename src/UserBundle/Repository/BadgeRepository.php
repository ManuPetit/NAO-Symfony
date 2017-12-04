<?php
/**
 * Created by PhpStorm.
 * User: Emmanuel
 * Date: 09/11/2017
 * Time: 16:33
 */

namespace UserBundle\Repository;

use Doctrine\ORM\EntityRepository;
use UserBundle\Entity\User;

class BadgeRepository extends EntityRepository
{
    public function getTotalBadgeNumber(User $user)
    {
        return $this->createQueryBuilder('b')
            ->leftJoin('b.users', 'u')
            ->andWhere('u = :user')
            ->setParameter('user', $user)
            ->select('COUNT(b)')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function getNumberOfObservationBadge(User $user)
    {
        return $this->createQueryBuilder('b')
            ->leftJoin('b.users', 'u')
            ->andWhere('u = :user')
            ->setParameter('user', $user)
            ->andWhere('b.id >= 1')
            ->andWhere('b.id <5')
            ->select('COUNT(b)')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function getNumberOfPhotoBadge(User $user)
    {
        return $this->createQueryBuilder('b')
            ->leftJoin('b.users', 'u')
            ->andWhere('u = :user')
            ->setParameter('user', $user)
            ->andWhere('b.id > 4')
            ->andWhere('b.id <9')
            ->select('COUNT(b)')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function getNumberOfAncienneteBadge(User $user)
    {
        return $this->createQueryBuilder('b')
            ->leftJoin('b.users', 'u')
            ->andWhere('u = :user')
            ->setParameter('user', $user)
            ->andWhere('b.id > 8')
            ->andWhere('b.id <=12')
            ->select('COUNT(b)')
            ->getQuery()
            ->getSingleScalarResult();
    }
}