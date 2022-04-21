<?php

namespace App\Repository;

use App\Entity\StudentEntity;
use App\Helpers\GlobalFunctions;
use App\Interface\StudentInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class StudentEntityRepository extends ServiceEntityRepository implements StudentInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StudentEntity::class);
        $this->registry = $registry;
    }
    
    /**
     * @return array with entity StudentEntity or empty
     */
    public function showAll(): array
    {
        return $this->findAll();
    }
    
    /**
     * @param int $id
     * @return mixed entity StudentEntity or empty
     */
    public function findUser(int $id): mixed
    {
        $find = $this->find($id);

        return $find;
    }

    /**
     * @param array $request
     * @return StudentEntity StudentEntity
     */
    public function create(array $request): StudentEntity
    {
        $students = new StudentEntity;

        $students->setName($request['name']);
        $students->setEmail($request['email']);
        $students->setStatus($request['status']);
        $students->setBirthDay($request['birthday']);
        $students->setCreatedAt(new \DateTime("now", new \DateTimeZone("America/Sao_Paulo")));
        $students->setUpdatedAt(new \DateTime("now", new \DateTimeZone("America/Sao_Paulo")));

        $doctrine = $this->registry->getManager();
        $doctrine->persist($students);
        $doctrine->flush();

        return $students;
    }
    
    /**
     * @param array $request
     * @param int $id
     * 
     * @return mixed entity StudentEntity or string message of the error
     */
    public function update(array $request, int $id): mixed
    {

        $students  =  $this->find($id);

        if (isset($request['name'])) {
            $students->setName($request['name']);
        }

        if (isset($request['email'])) {
            $students->setEmail($request['email']);
        }

        if (isset($request['birthday'])) {
            $function = new GlobalFunctions;
            $time = strtotime($request['birthday']);
            $newformat = date('Y-d-m', $time);


            if (isset($request['birthday'])) {
                $time = strtotime($request['birthday']);
                $newformat = date('Y-d-m', $time);
                $request['birthday'] = $function->convertToDateTime($newformat);

                if ($function->ageCalculate($newformat)) {
                    $students->setBirthDay($request['birthday']);
                } else {
                    $msg = "Usuário menor de 16 anos, não pode ser cadastrado";
                    return $msg;
                };
            }
        }

        if (isset($request['status'])) {
            $students->setStatus($request['status']);
        }

        $students->setUpdatedAt(new \DateTime("now", new \DateTimeZone("America/Sao_Paulo")));

        $doctrine = $this->registry->getManager();
        $doctrine->flush();

        return $students;
    }
    
    /**
     * @param int $id
     * 
     * @return StudentEntity StudentEntity
     */
    public function findReturnModel(int $id): StudentEntity
    {
        $find = $this->find($id);

        return $find;
    }

    /**
     * @param int $id
     * 
     * @return string message sucess or fail
     */
    public function delete(int $id): string
    {
        $students  =  $this->find($id);
        $msg = "Registro Deletado com Sucesso";

        $doctrine = $this->registry->getManager();
        $doctrine->remove($students);
        $doctrine->flush();

        return $msg;
    }
}
