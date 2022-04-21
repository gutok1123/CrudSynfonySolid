<?php

namespace App\Interface;

use App\Entity\CoursesEntity;
use App\Entity\RegisterEntity;
use App\Entity\StudentAccountEntity;
use App\Entity\StudentEntity;

interface RegisterInterface
{
    public function create(StudentEntity $studentId, StudentAccountEntity $studentAccountId, CoursesEntity $coursesId): RegisterEntity;
    public function update(array $request, int $id): mixed;
    public function findIdCourses(int $id): mixed;
    public function findIdStudent(int $id): mixed;
    public function delete(int $id): string;
    public function showAll():Array;
    
}
