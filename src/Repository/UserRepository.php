<?php

namespace Imie\Repository;

use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
    public function getUserByLogin($email, $password)
    {
        return $this
            ->createQueryBuilder('u')
            ->where('u.email = :email_user')
            ->andWhere('u.password = :password_user')
            ->setParameter('email_user', $email)
            ->setParameter('password_user', $password)
            ->getQuery()
            ->getSingleResult() // Renvoie l'utilisateur si il le trouve, sinon ça lance une exception
            // ->getOneOrNullResult() // Renvoie l'utilisateur si il le trouve, sinon renvoie null
        ;
    }
}
