<?php

namespace App\Interface;
use App\Entity\RegisterEntity;

interface RegisterInterface
{
    public function create(array $request): RegisterEntity;
    public function update(array $request, int $id): mixed;
    public function findUser(int $id): mixed;
    public function delete(int $id): string;
    public function showAll():Array;
    
}
