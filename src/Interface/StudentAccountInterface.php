<?php
namespace App\Interface;
use App\Entity\StudentAccountEntity;

interface StudentAccountInterface
{
    public function create(array $request): StudentAccountEntity;
    public function findReturnModel(int $id): StudentAccountEntity;
    public function update(array $request, int $id): mixed;
    public function findUser(int $id): mixed;
    public function delete(int $id): string;
    public function showAll(): Array;
    
}