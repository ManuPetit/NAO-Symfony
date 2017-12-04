<?php
/**
 * Created by PhpStorm.
 * User: Emmanuel
 * Date: 09/11/2017
 * Time: 16:36
 */

namespace UserBundle\Repository;

use Doctrine\ORM\EntityRepository;
use UserBundle\Entity\Badge;
use UserBundle\Entity\User;

class UserRepository extends EntityRepository
{
    public function getAllValidUsers($currentUser, $role = null)
    {
        if (isset($role) && $role > 0){
            $qb = $this->createQueryBuilder('u')
                ->leftJoin('u.userStatus', 'us')
                ->leftJoin('u.role', 'r')
                ->andWhere('u <> :current_user')
                ->setParameter('current_user', $currentUser)
                ->addSelect('us')
                ->addSelect('r')
                ->andWhere('r.id = :role')
                ->setParameter('role', $role)
                ->andWhere('us.id <> 3')
                ->orderBy('u.login')
                ->getQuery()
                ->getResult();
        } else {
            $qb = $this->createQueryBuilder('u')
                ->leftJoin('u.userStatus', 'us')
                ->leftJoin('u.role', 'r')
                ->andWhere('u.id <> :current_user')
                ->setParameter('current_user', $currentUser)
                ->addSelect('us')
                ->addSelect('r')
                ->andWhere('us.id <> 3')
                ->orderBy('u.login')
                ->getQuery()
                ->getResult();
        }

        return $qb;
    }

    public function getAllValidUsersBySearch($currentUser, $search)
    {
        return $this->createQueryBuilder('u')
            ->leftJoin('u.userStatus', 'us')
            ->leftJoin('u.role', 'r')
            ->andWhere('u <> :current_user')
            ->setParameter('current_user', $currentUser)
            ->addSelect('us')
            ->addSelect('r')
            ->andWhere('us.id <> 3')
            ->andWhere('LOWER(u.login) LIKE LOWER(:search)')
            ->setParameter('search', '%' . $search . '%')
            ->orderBy('u.login')
            ->getQuery()
            ->getResult();
    }

    public function hasUserGotBadge(User $user, Badge $badge)
    {
        return $this->createQueryBuilder('u')
            ->join('u.badges', 'b')
            ->andWhere('u = :user')
            ->setParameter('user', $user)
            ->andWhere('b = :badge')
            ->setParameter('badge', $badge)
            ->select('COUNT(u)')
            ->getQuery()
            ->getSingleScalarResult();
    }
}