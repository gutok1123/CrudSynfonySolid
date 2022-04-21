<?php

namespace App\Repository;

use App\Entity\CoursesEntity;
use App\Entity\RegisterEntity;
use App\Entity\StudentAccountEntity as EntityStudentAccountEntity;
use App\Entity\StudentEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Interface\RegisterInterface;


class RegisterEntityRepository extends ServiceEntityRepository implements RegisterInterface
{
    private $registry, $student;
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RegisterEntity::class);
        $this->registry = $registry;
    }

    /**
     * @return array with entity RegisterEntity or empty
     */
    public function showAll(): array
    {
        return $this->findAll();
    }

     /**
     * @param int $id
     * @return mixed entity RegisterEntity or empty
     */
    public function findIdRegister(int $id): mixed
    {
        $find = $this->find($id);

        return $find;
    }

    /**
     * @param int $id
     * @return mixed entity RegisterEntity or empty
     */
    public function findIdCourses(int $id): mixed
    {

        $find = $this->findBy(['courses_id' => $id]);

        return  $find;
    }

    /**
     * @param int $id
     * 
     * @return mixed entity RegisterEntity or empty
     */
    public function findIdStudent(int $id): mixed
    {
        $find = $this->findBy(['student_id' => $id]);


        return  $find;
    }

    /**
     *@param StudentEntity $studentId
     * @param EntityStudentAccountEntity $studentAccountId
     * @param CoursesEntity $coursesId
     * @param int $id
     * 
     * @return RegisterEntity RegisterEntity
     */
    public function create(StudentEntity $studentId, EntityStudentAccountEntity $studentAccountId, CoursesEntity $coursesId): RegisterEntity
    {

        $register = new RegisterEntity;
        $register->setStudentId($studentId);
        $register->setCoursesId($coursesId);
        $register->setStudentAccountId($studentAccountId);
        $register->setCreatedAt(new \DateTime("now", new \DateTimeZone("America/Sao_Paulo")));
        $register->setUpdatedAt(new \DateTime("now", new \DateTimeZone("America/Sao_Paulo")));

        $doctrine = $this->registry->getManager();
        $doctrine->persist($register);
        $doctrine->flush();
        return $register;
    }


    /**
     * @param mixed entity StudentEntity or empty
     * @param mixed entity StudentAccount or empty
     * @param mixed entity CoursesEntity or empty
     * @param int $id
     * 
     * @return mixed entity StudenAccounttEntity or string message of the error
     */
    public function update(mixed $studentId, mixed $studentAccountId, mixed $coursesId, int $id): mixed
    {

        $register  =  $this->find($id);
        
        

        if (!empty($studentId)) {
            $register->setStudentId($studentId);
        }

        if (!empty($studentAccountId)) {
            $register->setStudentAccountId($studentAccountId);
        }

        if (!empty($coursesId)) {
            $register->setCoursesId($coursesId);
        }

        $register->setUpdatedAt(new \DateTime("now", new \DateTimeZone("America/Sao_Paulo")));

        $doctrine = $this->registry->getManager();
        $doctrine->flush();

        return $register;
    }

    /**
     * @param int $id
     * 
     * @return string message sucess or fail
     */
    public function delete(int $id): string
    {
        $courses  =  $this->find($id);
        $msg = "Registro Deletado com Sucesso";

        $doctrine = $this->registry->getManager();
        $doctrine->remove($courses);
        $doctrine->flush();

        return $msg;
    }
}
