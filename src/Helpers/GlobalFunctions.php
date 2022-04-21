<?php

namespace App\Helpers;

use PhpParser\Node\Expr\Cast\Bool_;

class GlobalFunctions
{
    public function ageCalculate(string $secondDate): ?Bool
    {

        $firstDate = Date('Y-m-d');
        $dateDifference = abs(strtotime($secondDate) - strtotime($firstDate));

        $years  = floor($dateDifference / (365 * 60 * 60 * 24));
        $months = floor(($dateDifference - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
        $days   = floor(($dateDifference - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));


        if ($years > 16) {
            return true;
        } else {
            return false;
        }
    }

     /**
     * @param string date
     * 
     * @return string $newFormat
     */
    public function converterTypeDateTime(string $date) : string
    {
      
      $ano= substr($date, 6);
      $mes= substr($date, 3,-5);
      $dia= substr($date, 0,-8);
      $result =  $ano."-".$mes."-".$dia;
      
      return $result;

    }


    public function convertToDateTime(string $date): ?\DateTimeInterface
    {

        $newDateFormat = new \DateTime($date, new \DateTimeZone("America/Sao_Paulo"));

        return $newDateFormat;
    }



    public  function setValidateConditionalsRegisterSystemCreate(
        \DateTime $initial_date,
        \DateTime $finalDate,
        string $status,
        int $countStudents,
        mixed $idCoursesVerification,
        int $idCourses
    ): mixed {

        date_default_timezone_set('America/Sao_Paulo');
        $date = date('y-m-d');
        $initial_date->format('d-m-y');
        if ($idCoursesVerification == $idCourses) {
            return $msg = "O Aluno já está cadastrado neste curso,você pode se candidatar a outros cursos, lamento, mas você não pode mais participar deste";
        }
        if (strtotime($initial_date->format('y-m-d')) <= strtotime($date)) {
    
            return $msg = "O curso esta em andamento ou foi encerrado ,lamento, mas você não pode mais participar";
        }

        if ($status == "Inativo") {
            return $msg = "O Usuario está inativo, lamento, mas você não pode mais participar";
        }

        if ($countStudents == 10) {
            return $msg = "O Curso Atingiu seu limite máximo de participantes, lamento, mas você não pode mais participar";
        }
        return true;
    }

    public  function setValidateConditionalsRegisterSystemUpdate(
        mixed $initial_date,
        mixed $finalDate,
        string $status,
        mixed $countStudents,
        mixed $idCoursesVerification,
        mixed $idCourses
    ): mixed {

        date_default_timezone_set('America/Sao_Paulo');
        $date = date('d-m-y');

        $initial_date = !empty($initial_date) ? $initial_date->format('d-m-y') : '';

        if ($idCoursesVerification == $idCourses) {
            return $msg = "O Aluno já está cadastrado neste curso,você pode se candidatar a outros cursos, lamento, mas você não pode mais participar deste";
        }

        if (!empty($initial_date)) {
            if (strtotime($initial_date) <= strtotime($date)) {
            
                return $msg = "O curso esta em andamento ou foi encerrado, lamento, mas você não pode mais participar";
            }
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
