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
    
    /**
     * @return array with entity StudentAccountEntity or empty
     */
    public function showAll():Array
    {
        return $this->findAll();
    }
    
     /**
     * @param int $id
     * @return mixed entity StudentAccountEntity or empty
     */
    public function findUser(int $id): mixed
    {
        $find = $this->find($id);

        return $find;
    }
    
    /**
     * @param array $request
     * 
     * @return StudentAccountEntity StudentAccountEntity
     */
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
    
    /**
     * @param array $request
     * @param int $id
     * 
     * @return mixed entity StudenAccounttEntity or string message of the error
     */
     public function update(array $request, int $id): mixed
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

     /**
     * @param int $id
     * 
     * @return StudentAccountEntity StudentAccountEntity
     */
     public function findReturnModel(int $id): StudentAccountEntity
     {
         $find = $this->find($id);

         return $find;
     }
     
     /**
     * @param int $id
     * 
     * @return string message sucess or fail
     */
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
