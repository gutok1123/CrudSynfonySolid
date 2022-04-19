<?php
namespace App\Interface;
use App\Entity\StudentAccountEntity;

interface StudentAccountInterface
{
    public function create(array $request): StudentAccountEntity;
    public function update(array $request, int $id): StudentAccountEntity;
    public function delete(int $id): string;
    public function showAll():Array;
    
}