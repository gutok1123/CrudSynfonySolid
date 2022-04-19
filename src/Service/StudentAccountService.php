<?php

namespace App\Service;
use App\Entity\StudentAccountEntity;
use App\Interface\StudentAccountInterface;

class StudentAccountService
{
    private $repository;
    public function __construct(StudentAccountInterface $repository)
    {
        $this->repository = $repository;
    }

    public function showAll()
    {
      return $this->repository->showAll();
    }
    
    public function create(array $request)
    {
     
      return $this->repository->create($request);
    
    }

    public function update(array $request, int $id): StudentAccountEntity
    {
      return $this->repository->update($request,$id);
    }

    public function delete(int $id): string
    {
      return $this->repository->delete($id);
    }

   
    
}