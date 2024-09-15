<?php

namespace App\Service;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

class PaginatorService
{
    public readonly int $total;

    public readonly int $lastPage;

    public readonly mixed $items;

    public function paginate(EntityRepository $repo, int $page = 1, int $limit = 24): static
    {
        $query = $repo->createQueryBuilder('q')
            ->orderBy('q.id', 'DESC')
            ->getQuery();

        $paginator = new Paginator($query);

        $paginator->getQuery()
            ->setFirstResult($limit * ($page - 1))
            ->setMaxResults($limit);

        $this->total = $paginator->count();
        $this->lastPage = (int) ceil($paginator->count() / $paginator->getQuery()->getMaxResults());
        $this->items = $paginator;

        return $this;
    }
}
