<?php

namespace App\Service;
use App\Entity\CoursesEntity;
use App\Interface\CoursesInterface;

class CoursesService
{
    private $repository;
    public function __construct(CoursesInterface $repository)
    {
        $this->repository = $repository;
    }

    public function showAll()
    {
      return $this->repository->showAll();
    }
    public function create(array $request): CoursesEntity
    {
      return $this->repository->create($request);
    }

    public function update(array $request, int $id): CoursesEntity
    {
      return $this->repository->update($request,$id);
    }

    public function delete(int $id): string
    {
      return $this->repository->delete($id);
    }
    
}
