<?php

namespace App\Repository;

use App\Entity\CoursesEntity;
use App\Entity\RegisterEntity;
use App\Entity\StudentAccountEntity as EntityStudentAccountEntity;
use App\Entity\StudentEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Interface\RegisterInterface;
use Proxies\__CG__\App\Entity\StudentAccountEntity;

class RegisterEntityRepository extends ServiceEntityRepository implements RegisterInterface
{
    private $registry, $student;
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RegisterEntity::class);
        $this->registry = $registry;
        
    }

    public function showAll():Array
    {
        return $this->findAll();
    }
    
    public function findUser(int $id): mixed
    {
        
        $find = $this->findBy(['courses_id' => $id]);

        return  $find;
    }
   
    public function create(StudentEntity $studentId, EntityStudentAccountEntity $studentAccountId, CoursesEntity $coursesId): RegisterEntity
    {
        
        $register = new RegisterEntity;
        $register->setStudentId($studentId);
        $register->setCoursesId($coursesId);
        $register->setStudentAccountId($studentAccountId);
        
         $doctrine = $this->registry->getManager();
         $doctrine->persist($register);
         $doctrine->flush();
         return $register;
    }

    
    
     public function update(array $request, int $id): mixed
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
   
}
