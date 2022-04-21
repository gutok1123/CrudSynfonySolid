<?php

namespace App\Repository;

use App\Entity\StudentEntity;
use App\Interface\StudentInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class StudentEntityRepository extends ServiceEntityRepository implements StudentInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StudentEntity::class);
        $this->registry = $registry;
    }

    public function showAll():Array
    {
        return $this->findAll();
    }

    public function findUser(int $id): mixed
    {
        $find = $this->find($id);

        return $find;
    }

    public function create(array $request): StudentEntity
    {
        $students = new StudentEntity;
        $students->setName($request['name']);
        $students->setEmail($request['email']);
        $students->setStatus($request['status']);
        $students->setBirthDay($request['birthday']);
        $students->setCreatedAt(new \DateTime("now", new \DateTimeZone("America/Sao_Paulo")));
        $students->setUpdatedAt(new \DateTime("now", new \DateTimeZone("America/Sao_Paulo")));
       
        $doctrine = $this->registry->getManager();
        $doctrine->persist($students);
        $doctrine->flush();
  
        return $students;
    }
    
     public function update(array $request, int $id): mixed
     {
    
       $students  =  $this->find($id);
       
        if(isset($request['name']))
        {
            $students->setName($request['name']);
        }

        if(isset($request['email']))
        {
            $students->setEmail($request['email']);
        }

        if(isset($request['birthday']))
        {
            $students->setBirthDay($request['birthday']);
        }

        if(isset($request['status']))
        {
            $students->setStatus($request['status']);
        }

        $students->setUpdatedAt(new \DateTime("now", new \DateTimeZone("America/Sao_Paulo")));

        $doctrine = $this->registry->getManager();
        $doctrine->flush();

       return $students;
     }

     public function findReturnModel(int $id): StudentEntity
     {
         $find = $this->find($id);

         return $find;
     }

    
     public function delete(int $id): string
     {
        $students  =  $this->find($id); 
        $msg = "Registro Deletado com Sucesso";

        $doctrine = $this->registry->getManager();
        $doctrine->remove($students);
        $doctrine->flush();

         return $msg;
     }    

    
}
