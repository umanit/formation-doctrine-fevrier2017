<?php

namespace Imie\Repository;

use Doctrine\ORM\EntityRepository;

class PostRepository extends EntityRepository
{
    public function search($searchedWord)
    {
        $queryBuilder = $this->createQueryBuilder('p');
        $queryBuilder->where('p.subject LIKE :searched_word');
        $queryBuilder->orderBy('p.subject', 'DESC');
        $queryBuilder->setParameter('searched_word', '%'. $searchedWord .'%');

        return $queryBuilder->getQuery()->getResult();
    }
}
