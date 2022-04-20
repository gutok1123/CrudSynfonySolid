<?php

namespace App\Interface;
use App\Entity\CoursesEntity;

interface CoursesInterface
{
    public function create(array $request): CoursesEntity;
    public function update(array $request, int $id): mixed;
    public function findUser(int $id): mixed;
    public function delete(int $id): string;
    public function showAll():Array;
    
}
