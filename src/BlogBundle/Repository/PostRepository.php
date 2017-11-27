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
            ->leftJoin('p.mainStatus', 'status')
            ->andWhere('status.name = :status')
            ->setParameter('status', 'Publié')
            ->setFirstResult($first)
            ->setMaxResults($limit)
        ;
        return new Paginator($qb);
    }

    /**
     * Function to retrieve all the articles (except en attente or supprimé)
     * or to retrieve the article with the filter status
     * @param null $filter
     * @return array
     */
    public function getAllPosts($filter = null)
    {
        if (isset($filter) && $filter != ''){
            $qb = $this->createQueryBuilder('p')
                ->leftJoin('p.mainStatus', 'ms')
                ->addSelect('ms')
                ->andWhere('ms.id = :filter')
                ->setParameter('filter', $filter)
                ->orderBy('p.title')
                ->getQuery()
                ->getResult();
        } else {
            $deleted = 'Supprimé';
            $not_ready = 'En attente de validation';
            $qb = $this->createQueryBuilder('p')
                ->leftJoin('p.mainStatus', 'ms')
                ->addSelect('ms')
                ->andWhere('ms.name <> :deleted')
                ->setParameter('deleted', $deleted)
                ->andWhere('ms.name <> :not_ready')
                ->setParameter('not_ready', $not_ready)
                ->orderBy('ms.id')
                ->getQuery()
                ->getResult();
        }
        return $qb;
    }

    public function getAllPostBySearch($search)
    {
        $deleted = 'Supprimé';
        $not_ready = 'En attente de validation';
        return $this->createQueryBuilder('p')
            ->andWhere('LOWER(p.title) LIKE LOWER(:search)')
            ->setParameter('search', '%' . $search . '%')
            ->leftJoin('p.mainStatus', 'ms')
            ->addSelect('ms')
            ->andWhere('ms.name <> :deleted')
            ->setParameter('deleted', $deleted)
            ->andWhere('ms.name <> :not_ready')
            ->setParameter('not_ready', $not_ready)
            ->orderBy('ms.id')
            ->getQuery()
            ->getResult();
    }

}