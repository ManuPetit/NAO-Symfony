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
    /**
     * @param $first : set the offset of results returned
     * @param $limit : set the limit of results returned
     * @param $order : order of results returned
     * @return Paginator : list of results
     */
    public function getLastPosts($first = 0, $limit = 3, $order = 'DESC')
    {
        $qb = $this
            ->createQueryBuilder('p')
            ->leftJoin('p.blogImages', 'blog')
            ->addSelect('blog')
            ->orderBy('p.date', $order)
            ->setFirstResult($first)
            ->setMaxResults($limit)
        ;
        return new Paginator($qb);
    }
}