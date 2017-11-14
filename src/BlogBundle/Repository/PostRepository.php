<?php
/**
 * Created by PhpStorm.
 * User: Emmanuel
 * Date: 09/11/2017
 * Time: 16:02
 */

namespace BlogBundle\Repository;

use Doctrine\ORM\EntityRepository;

class PostRepository extends EntityRepository
{
    public function getLastArticles()
    {
        $qb = $this
            ->createQueryBuilder('p')
            ->leftJoin('p.blogImages', 'blog')
            ->addSelect('blog')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult()
        ;
        return $qb;
    }
}