<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function save(User $user, bool $flush = true): User
    {
        try {
            $this->getEntityManager()->persist($user);

            if ($flush) {
                $this->getEntityManager()->flush();
            }
           
            return $user;
        } catch (\Exception $exception) {
            throw new \Exception($exception);
        }
    }
}
