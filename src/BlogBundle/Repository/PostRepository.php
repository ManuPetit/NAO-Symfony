<?php
/**
 * Created by PhpStorm.
 * User: Emmanuel
 * Date: 09/11/2017
 * Time: 16:02
 */

namespace BlogBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

class PostRepository extends EntityRepository
{
    public function getLastPosts($limit = 3)
    {
        $qb = $this
            ->createQueryBuilder('p')
            ->leftJoin('p.blogImages', 'blog')
            ->addSelect('blog')
            ->orderBy('p.date', 'DESC')
            ->setFirstResult(0)
            ->setMaxResults($limit)
        ;
        return new Paginator($qb);
    }
}