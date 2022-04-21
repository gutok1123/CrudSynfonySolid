<?php

namespace App\Service;
use App\Interface\CoursesInterface;
use App\Helpers\GlobalFunctions;

class CoursesService
{
    private $repository;
    public function __construct(CoursesInterface $repository)
    {
        $this->repository = $repository;
    }
    
    /**
     * @return mixed entity CoursesEntity or empty
     */
    public function showAll()
    {
      return $this->repository->showAll();
    }
    
    /**
     * @param int $id
     * @return mixed entity CourseEntity or empty
     */
    public function find(int $id) : mixed
    {
      return $this->repository->findUser($id);
    }
    
    /**
     * @param array $request
     * @return mixed entity CourseEntity or string message
     */
    public function create(array $request): mixed
    {
      $function = new GlobalFunctions;

      $newInitialDate = $this->converterTypeDateTime($request['initial_date']);

      $newFinalDate = $this->converterTypeDateTime($request['final_date']);

      $request['initial_date'] = $function->convertToDateTime($newInitialDate);

      $request['final_date'] = $function->convertToDateTime($newFinalDate);
       
       
      return $this->repository->create($request);
    }

    
    /**
     * @param array $request
     * @param int $id
     * 
     * @return mixed entity CoursesEntity or empty
     */
    public function update(array $request, int $id): mixed
    {
      $function = new GlobalFunctions;
       
      $newInitialDate = isset($request['initial_date']) ? $this->converterTypeDateTime($request['initial_date']) : false ;

      $newFinalDate = isset($request['final_date']) ? $this->converterTypeDateTime($request['final_date']) : false;
      
      $request['initial_date'] = $newInitialDate ? $function->convertToDateTime($newInitialDate) : false;
      
      $request['final_date'] = $newFinalDate ? $function->convertToDateTime($newFinalDate) : false;
       
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

    /**
     * @param string date
     * 
     * @return string $newFormat
     */
    public function converterTypeDateTime(string $date) : string
    {
      $time = strtotime($date);

      $newFormat = date('Y-d-m',$time);
      
      return $newFormat;

    }

    
}
