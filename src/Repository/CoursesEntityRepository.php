<?php

namespace App\Repository;

use App\Entity\CoursesEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Interface\CoursesInterface;

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
   
}
