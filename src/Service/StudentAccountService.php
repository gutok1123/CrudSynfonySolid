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
    
    /**
     * @return mixed Entity StudenAccountEntity or empty
     */
    public function showAll() : mixed
    {
      return $this->repository->showAll();
    }
   
    /**
     * @param int $id
     * 
     * @return mixed Entity StudenAccountEntity or empty
     */
    public function find(int $id) : mixed
    {
      return $this->repository->findUser($id);
    }
    
     /**
     * @param array $request
     * 
     * @return StudentAccountEntity StudentAccountEntity
     */
    public function create(array $request) : StudentAccountEntity
    {
     
      return $this->repository->create($request);
    
    }

    /**
     * @param array $request
     * @param int $id
     * 
     * @return mixed Entity StudentAccountEntity or empty
     */
    public function update(array $request, int $id): mixed
    {
      return $this->repository->update($request,$id);
    }
    
    /**
     * @param int $id
     * 
     * @return string message sucess or fail
     */
    public function delete(int $id): string
    {
      return $this->repository->delete($id);
    }

   
    
}