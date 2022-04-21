<?php

namespace App\Service;


use App\Interface\RegisterInterface;
use App\Interface\CoursesInterface;
use App\Interface\StudentInterface;


class RegisterService
{
  private $repository, $repositoryCourses, $repositoryStudent;
  public function __construct(RegisterInterface $repository, CoursesInterface $repositoryCourses, StudentInterface $repositoryStudent)
  {
    $this->repository = $repository;
    $this->repositoryCourses = $repositoryCourses;
    $this->repositoryStudent = $repositoryStudent;
  }

  public function showAll() : mixed
  {
    return $this->repository->showAll();
  }

  public function find(int $id): mixed
  {
    return $this->repository->findUser($id);
  }

  public function create(array $request) :mixed
  {

    if (is_array($this->getValidateConditionalsRegisterSystem($request))) {
      dd("ok");
      return $this->repository->create($this->getValidateConditionalsRegisterSystem($request));
  }


    return $this->getValidateConditionalsRegisterSystem($request);
  }
  

  public function update(array $request, int $id): mixed
  {
    return $this->repository->update($request, $id);
  }

  public function delete(int $id): string
  {
    return $this->repository->delete($id);
  }

  public function getValidateConditionalsRegisterSystem(array $request): mixed
  {
    $dateCourses = $this->repositoryCourses->findUser($request['course_id']);
    $countStudentsCourses = count($this->repository->findUser($request['course_id']));
    $statusStudent = $this->repositoryStudent->findUser($request['student_id']);

    if ($this->setValidateConditionalsRegisterSystem(
      $dateCourses->getInitialDate(),
      $dateCourses->getFinalDate(),
      $statusStudent->getStatus(),
      $countStudentsCourses
    ) !== true) {
      return $this->setValidateConditionalsRegisterSystem(
        $dateCourses->getInitialDate(),
        $dateCourses->getFinalDate(),
        $statusStudent->getStatus(),
        $countStudentsCourses
      );
    };

    return $request;
  }

  public  function setValidateConditionalsRegisterSystem(\DateTime $initial_date, \DateTime $finalDate, string $status, int $countStudents): mixed
  {
    date_default_timezone_set('America/Sao_Paulo');
    $date = date('d-m-y');
    $initial_date->format('d-m-y');

    if (strtotime($initial_date->format('d-m-y')) <= strtotime($date)) {
      if (strtotime($finalDate->format('d-m-y')) < strtotime($date)) {
        return $msg = "O Curso foi encerrado, lamento, mas você não pode mais participar";
      }
      return $msg = "O curso esta em andamento, lamento, mas você não pode mais participar";
    }

    if ($status == "Inativo") {
      return $msg = "O Usuario está inativo, lamento, mas você não pode mais participar";
    }

    if ($countStudents == 10) {
      return $msg = "O Curso Atingiu seu limite máximo de participantes, lamento, mas você não pode mais participar";
    }
    return true;
  }
}
