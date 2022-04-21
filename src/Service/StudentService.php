<?php

namespace App\Service;

use App\Interface\StudentInterface;
use App\Helpers\GlobalFunctions;

class StudentService
{
    private $repository;
    public function __construct(StudentInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return mixed entity StudentEntity or empty
     */
    public function showAll()
    {
      return $this->repository->showAll();
    }

    /**
     * @param int $id
     * @return mixed entity StudentEntity or empty
     */
    public function find(int $id) : mixed
    {
      return $this->repository->findUser($id);
    }

    /**
     * @param array $request
     * @return mixed entity StudentEntity or string message
     */
    public function create(array $request): mixed
    {
      $function = new GlobalFunctions;     
     
      $time = strtotime($request['birthday']);
      $newformat = date('Y-d-m',$time);
      $request['birthday'] = $function->convertToDateTime($newformat);
      
       if($function->ageCalculate($newformat))
        {
          return $this->repository->create($request);
        }else{
          $msg = "Usuário menor de 16 anos, não pode ser cadastrado";
          return $msg;
        };
    }
    
    /**
     * @param array $request
     * @param int $id
     * 
     * @return mixed entity StudentEntity or empty
     */
    public function update(array $request, int $id): mixed
    {
      
      return $this->repository->update($request,$id);
    }

    /**
     * @param int $id
     * @return string message sucess or fail
     */
    public function delete(int $id): string
    {
      return $this->repository->delete($id);
    }

  }
