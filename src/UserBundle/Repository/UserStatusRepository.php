<?php
/**
 * Created by PhpStorm.
 * User: Emmanuel
 * Date: 09/11/2017
 * Time: 16:36
 */

namespace UserBundle\Repository;

use Doctrine\ORM\EntityRepository;

class UserStatusRepository extends EntityRepository
{
    public function getAllValidUserStatus()
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.name <> :deleted')
            ->setParameter('deleted', 'Supprimé')
            ->orderBy('s.id')
            ->getQuery()
            ->getResult();
    }
}