<?php

namespace App\Service;

use App\Helpers\GlobalFunctions;
use App\Interface\RegisterInterface;
use App\Interface\CoursesInterface;
use App\Interface\StudentAccountInterface;
use App\Interface\StudentInterface;


class RegisterService
{
  private $repository, $repositoryCourses, $repositoryStudent, $repositoryStudentAccount;
  public function __construct(RegisterInterface $repository, CoursesInterface $repositoryCourses, StudentInterface $repositoryStudent, StudentAccountInterface $repositoryStudentAccount)
  {
    $this->repository = $repository;
    $this->repositoryCourses = $repositoryCourses;
    $this->repositoryStudent = $repositoryStudent;
    $this->repositoryStudentAccount = $repositoryStudentAccount;
  }


  /**
   * @return mixed entity RegisterEntity or empty
   */
  public function showAll(): mixed
  {
    return $this->repository->showAll();
  }

  /**
   * @param int $id
   * 
   * @return mixed Entity RegisterEntity or empty
   */
  public function find(int $id): mixed
  {
    return $this->repository->findIdRegister($id);
  }

  /**
   * @param array $request
   * @return mixed entity RegisterEntity or string message
   */
  public function create(array $request): mixed
  {

    if (is_array($this->getValidateConditionalsRegisterSystemCreate($request))) {
      $studentId = $this->repositoryStudent->findReturnModel($request['student_id']);
      $courseId = $this->repositoryCourses->findReturnModel(($request['course_id']));
      $studentAccountId = $this->repositoryStudentAccount->findReturnModel($request['student_account_id']);

      return $this->repository->create($studentId, $studentAccountId, $courseId);
    }


    return $this->getValidateConditionalsRegisterSystemCreate($request);
  }

  /**
   * @param array $request
   * @param int $id
   * 
   * @return mixed Entity RegisterEntity or empty
   */
  public function update(array $request, int $id): mixed
  {
    if (is_array($this->getValidateConditionalsRegisterSystemUpdate($request))) {
      $studentId = isset($request['student_id']) ? $this->repositoryStudent->findReturnModel($request['student_id']) : '';
      $courseId = isset($request['course_id']) ? $this->repositoryCourses->findReturnModel(($request['course_id'])) : '';
      $studentAccountId = isset($request['student_account_id']) ? $this->repositoryStudentAccount->findReturnModel($request['student_account_id']) : '';
     
      return $this->repository->update($studentId, $studentAccountId, $courseId, $id);
    }


    return $this->getValidateConditionalsRegisterSystemUpdate($request);
  }

  /**
   * @param int $id
   * 
   * @return string message sucess or fail
   */
  public function delete(int $id): string
  {
    return $this->repository->delete($id);
  }

  /**
   * @param array $request
   * 
   * @return mixed string warnings or array request
   */
  public function getValidateConditionalsRegisterSystemCreate(array $request): mixed
  {
    $globalFunction = new GlobalFunctions;
    
    $dateCourses = isset($request['course_id']) ? $this->repositoryCourses->findUser($request['course_id']) : '';
    $countStudentsCourses = isset($request['course_id']) ? count($this->repository->findIdCourses($request['course_id'])) : '';
    $statusStudent = isset($request['student_id']) ? $this->repositoryStudent->findUser($request['student_id']) : '';
    $registerVerification = isset($request['student_id']) ?  $this->repository->findIdStudent($request['student_id']) : '';
    $idCoursesVerification = isset($registerVerification[0]) ? $registerVerification[0]->getCoursesId()->getId() : '';


    
    
    if ($globalFunction->setValidateConditionalsRegisterSystemCreate(
      $dateCourses->getInitialDate(),
      $dateCourses->getFinalDate(),
      $statusStudent->getStatus(),
      $countStudentsCourses,
      $idCoursesVerification,
      $request['course_id']

    ) !== true) {
      return $globalFunction->setValidateConditionalsRegisterSystemCreate(
        $dateCourses->getInitialDate(),
        $dateCourses->getFinalDate(),
        $statusStudent->getStatus(),
        $countStudentsCourses,
        $idCoursesVerification,
        $request['course_id']
      );
    };

    return $request;
  }
  
    /**
   * @param array $request
   * 
   * @return mixed string warnings or array request
   */
  public function getValidateConditionalsRegisterSystemUpdate(array $request): mixed
  {
    $globalFunction = new GlobalFunctions;

    $dateCourses = isset($request['course_id']) ? $this->repositoryCourses->findUser($request['course_id']) : '';
    $countStudentsCourses = isset($request['course_id']) ? count($this->repository->findIdCourses($request['course_id'])) : '';
    $statusStudent = isset($request['student_id']) ? $this->repositoryStudent->findUser($request['student_id']) : '';
    $registerVerification = isset($request['student_id']) ?  $this->repository->findIdStudent($request['student_id']) : '';
    $idCoursesVerification = isset($registerVerification[0]) ? $registerVerification[0]->getCoursesId()->getId() : '';
    
    


    if (empty($statusStudent)) {
      if ($globalFunction->setValidateConditionalsRegisterSystemUpdate(
        $dateCourses->getInitialDate(),
        $dateCourses->getFinalDate(),
        $statusStudent,
        $countStudentsCourses,
        $idCoursesVerification,
        $request['course_id']

      ) !== true) {
        return $globalFunction->setValidateConditionalsRegisterSystemUpdate(
          $dateCourses->getInitialDate(),
          $dateCourses->getFinalDate(),
          $statusStudent,
          $countStudentsCourses,
          $idCoursesVerification,
          $request['course_id']
        );
      };
      return $request;
    } else {
      if (empty($dataCourses)) {
        if ($globalFunction->setValidateConditionalsRegisterSystemUpdate(
          $dateCourses,
          $dateCourses,
          $statusStudent->getStatus(),
          $countStudentsCourses,
          $idCoursesVerification,
          $request

        ) !== true) {
          return $globalFunction->setValidateConditionalsRegisterSystemUpdate(
            $dateCourses,
            $dateCourses,
            $statusStudent->getStatus(),
            $countStudentsCourses,
            $idCoursesVerification,
            $request
          );
        };
        return $request;
      }
    }
    if ($globalFunction->setValidateConditionalsRegisterSystemUpdate(
      $dateCourses->getInitialDate(),
      $dateCourses->getFinalDate(),
      $statusStudent->getStatus(),
      $countStudentsCourses,
      $idCoursesVerification,
      $request['course_id']

    ) !== true) {
      return $globalFunction->setValidateConditionalsRegisterSystemUpdate(
        $dateCourses->getInitialDate(),
        $dateCourses->getFinalDate(),
        $statusStudent->getStatus(),
        $countStudentsCourses,
        $idCoursesVerification,
        $request['course_id']
      );
    };

    return $request;
  }
}
