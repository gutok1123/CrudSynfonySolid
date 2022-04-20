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

    public function showAll() : mixed
    {
      return $this->repository->showAll();
    }

    public function find(int $id) : mixed
    {
      return $this->repository->findUser($id);
    }
    
    public function create(array $request) : StudentAccountEntity
    {
     
      return $this->repository->create($request);
    
    }

    public function update(array $request, int $id): mixed
    {
      return $this->repository->update($request,$id);
    }

    public function delete(int $id): string
    {
      return $this->repository->delete($id);
    }

   
    
}