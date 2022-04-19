<?php

namespace App\Repository;

use App\Entity\CoursesEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Interface\CoursesInterface;
/**
 * @method CoursesEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method CoursesEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method CoursesEntity[]    findAll()
 * @method CoursesEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CoursesEntityRepository extends ServiceEntityRepository implements CoursesInterface
{
    private $registry;
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CoursesEntity::class);
        $this->registry = $registry;
    }

    public function showAll():Array
    {
        return $this->findAll();
    }
    
    public function create(array $request): CoursesEntity
    {
        $courses = new CoursesEntity;
        $courses->setTitle($request['title']);
        $courses->setDescription($request['description']);
        $courses->setInitialDate($request['initial_date']);
        $courses->setFinalDate($request['final_date']);
        $courses->setCreatedAt(new \DateTime("now", new \DateTimeZone("America/Sao_Paulo")));
        $courses->setUpdatedAt(new \DateTime("now", new \DateTimeZone("America/Sao_Paulo")));
       
        $doctrine = $this->registry->getManager();
        $doctrine->persist($courses);
        $doctrine->flush();
  
        return $courses;
    }
    
     public function update(array $request, int $id): CoursesEntity
     {
    
       $courses  =  $this->find($id);
       
        if(isset($request['title']))
        {
            $courses->setTitle($request['title']);
        }

        if(isset($request['description']))
        {
            $courses->setDescription($request['description']);
        }

        if(isset($request['initial_date']))
        {
            $courses->setInitialDate($request['initial_date']);
        }


        if(isset($request['final_date']))
        {
            $courses->setFinalDate($request['final_date']);
        }

        $courses->setUpdatedAt(new \DateTime("now", new \DateTimeZone("America/Sao_Paulo")));

        $doctrine = $this->registry->getManager();
        $doctrine->flush();

       return $courses;
     }

     public function delete(int $id): string
     {
        $courses  =  $this->find($id); 
        $msg = "Registro Deletado com Sucesso";

        $doctrine = $this->registry->getManager();
        $doctrine->remove($courses);
        $doctrine->flush();

         return $msg;
     }    
    // /**
    //  * @throws ORMException
    //  * @throws OptimisticLockException
    //  */
    // public function add(CoursesEntity $entity, bool $flush = true): void
    // {
    //     $this->_em->persist($entity);
    //     if ($flush) {
    //         $this->_em->flush();
    //     }
    // }

    // /**
    //  * @throws ORMException
    //  * @throws OptimisticLockException
    //  */
    // public function remove(CoursesEntity $entity, bool $flush = true): void
    // {
    //     $this->_em->remove($entity);
    //     if ($flush) {
    //         $this->_em->flush();
    //     }
    // }

    // /**
    //  * @return CoursesEntity[] Returns an array of CoursesEntity objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CoursesEntity
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
