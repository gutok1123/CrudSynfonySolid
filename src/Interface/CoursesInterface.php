<?php

namespace App\Interface;
use App\Entity\CoursesEntity;

interface CoursesInterface
{
    public function create(array $request): CoursesEntity;
    public function update(array $request, int $id): CoursesEntity;
    public function showAll():Array;
    
}
