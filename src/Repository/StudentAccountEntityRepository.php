<?php

namespace App\Repository;

use App\Entity\StudentAccountEntity;
use App\Interface\StudentAccountInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


class StudentAccountEntityRepository extends ServiceEntityRepository implements StudentAccountInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StudentAccountEntity::class);
        $this->registry = $registry;
    }

    public function showAll():Array
    {
        return $this->findAll();
    }

    public function findUser(int $id): StudentAccountEntity
    {
        $find = $this->find($id);

        return $find;
    }

    public function create(array $request): StudentAccountEntity
    {
        $studentAccounts = new StudentAccountEntity;
        $studentAccounts->setName($request['name']);
        $studentAccounts->setEmail($request['email']);
        $studentAccounts->setStatus($request['status']);
        $studentAccounts->setCreatedAt(new \DateTime("now", new \DateTimeZone("America/Sao_Paulo")));
        $studentAccounts->setUpdatedAt(new \DateTime("now", new \DateTimeZone("America/Sao_Paulo")));
       
        $doctrine = $this->registry->getManager();
        $doctrine->persist($studentAccounts);
        $doctrine->flush();
  
        return $studentAccounts;
    }
    
     public function update(array $request, int $id): StudentAccountEntity
     {
    
       $studentAccounts  =  $this->find($id);
       
        if(isset($request['name']))
        {
            $studentAccounts->setName($request['name']);
        }

        if(isset($request['email']))
        {
            $studentAccounts->setEmail($request['email']);
        }

        if(isset($request['status']))
        {
            $studentAccounts->setStatus($request['status']);
        }

        $studentAccounts->setUpdatedAt(new \DateTime("now", new \DateTimeZone("America/Sao_Paulo")));

        $doctrine = $this->registry->getManager();
        $doctrine->flush();

       return $studentAccounts;
     }

     public function delete(int $id): string
     {
        $studentAccounts  =  $this->find($id); 
        $msg = "Registro Deletado com Sucesso";

        $doctrine = $this->registry->getManager();
        $doctrine->remove($studentAccounts);
        $doctrine->flush();

         return $msg;
     }    

    
}
