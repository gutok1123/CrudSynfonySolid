<?php

namespace App\Service;
use App\Entity\StudentEntity;
use App\Interface\StudentInterface;

class StudentService
{
    private $repository;
    public function __construct(StudentInterface $repository)
    {
        $this->repository = $repository;
    }

    public function showAll()
    {
      return $this->repository->showAll();
    }

    public function find(int $id)
    {
      return $this->repository->findUser($id);
    }
    
    public function create(array $request)
    {
     
      $time = strtotime($request['birthday']);

       $newformat = date('Y-m-d',$time);
       
        if($this->ageCalculate($newformat))
        {
          return $this->repository->create($request);
        }else{
          $msg = "Usuário menor de 16 anos, não pode ser cadastrado";
          return $msg;
        };
    }

    public function update(array $request, int $id): StudentEntity
    {
      return $this->repository->update($request,$id);
    }

    public function delete(int $id): string
    {
      return $this->repository->delete($id);
    }

    public function ageCalculate($secondDate)
    {

      $firstDate = Date('Y-m-d');
      $dateDifference = abs(strtotime($secondDate) - strtotime($firstDate));

      $years  = floor($dateDifference / (365 * 60 * 60 * 24));
      $months = floor(($dateDifference - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
      $days   = floor(($dateDifference - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 *24) / (60 * 60 * 24));
      
      
      if($years > 16)
      {
        return true;
      }else{
        return false;
      } ;
    }
    
}
