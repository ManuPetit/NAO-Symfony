<?php
/**
 * Created by PhpStorm.
 * User: Emmanuel
 * Date: 11/11/2017
 * Time: 08:16
 */

namespace NAOBundle\Repository;

use Doctrine\ORM\EntityRepository;

class MainStatusRepository extends EntityRepository
{
    /**
     * Function to get all the status in the filtered box
     * @return array
     */
    public function getObsFilterMainStatus()
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.id <> 1')
            ->andWhere('m.id <> 5')
            ->orderBy('m.id')
            ->getQuery()
            ->getResult();
    }

    /**
     * Function to get all the status that can be apllied to
     * an observation or article
     * @return array
     */
    public function getObsFilterToApply()
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.id <> 1')
            ->orderBy('m.id')
            ->getQuery()
            ->getResult();
    }

    /**
     * Returns all status but supprimé
     * @return array
     */
    public function getPostFilterMainStatus()
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.id <> 2')
            ->andWhere('m.id <> 5')
            ->orderBy('m.id')
            ->getQuery()
            ->getResult();
    }
}