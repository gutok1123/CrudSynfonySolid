<?php

namespace App\Service;
use App\Entity\StudentAccountEntity;
use App\Interface\RegisterInterface;

class RegisterService
{
    private $repository;
    public function __construct(RegisterInterface $repository)
    {
        $this->repository = $repository;
    }

    public function showAll() : mixed
    {
        
      return $this->repository->showAll();
    }
    
}