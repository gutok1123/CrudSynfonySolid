<?php

namespace App\Service;
use App\Entity\RegisterEntity;
use App\Interface\RegisterInterface;

class RegisterService
{
    private $repository;
    public function __construct(RegisterInterface $repository)
    {
        $this->repository = $repository;
    }

    public function showAll()
    {
      return $this->repository->showAll();
    }

    public function find(int $id) : mixed
    {
      return $this->repository->findUser($id);
    }
    
    public function create(array $request)
    {
      $initial_date = $this->repository->findUser($request['course_id']);
      dd($initial_date);
    //return $this->repository->create($request);
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
