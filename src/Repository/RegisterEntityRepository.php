<?php

namespace App\Repository;

use App\Entity\RegisterEntity;
use App\Interface\RegisterInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RegisterEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method RegisterEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method RegisterEntity[]    findAll()
 * @method RegisterEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RegisterEntityRepository extends ServiceEntityRepository implements RegisterInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RegisterEntity::class);
        $this->registry = $registry;
    }

    public function showAll()
    {
        return $this->findAll();
    }
}
