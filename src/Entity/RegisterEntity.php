<?php

namespace App\Entity;

use App\Repository\RegisterEntityRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\StudentEntity;
use App\Entity\StudentAccountEntity;
use App\Entity\CoursesEntity;

/**
 * @ORM\Entity(repositoryClass=RegisterEntityRepository::class)
 */
class RegisterEntity implements \JsonSerializable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;



    /**
     *@ORM\ManyToOne(targetEntity="App\Entity\StudentEntity", inversedBy="id")
     * @ORM\JoinColumn(name="student_id", referencedColumnName="id")
     */
    private $student_id;

    /**
     *@ORM\ManyToOne(targetEntity="App\Entity\StudentAccountEntity", inversedBy="id")
     * @ORM\JoinColumn(name="student_account_id", referencedColumnName="id")
     */
    private $student_account_id;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CoursesEntity", inversedBy="id")
     *  @ORM\JoinColumn(name="courses_id", referencedColumnName="id")
     */
    private $courses_id;


    /** @ORM\Column(type="datetime",columnDefinition="TIMESTAMP DEFAULT CURRENT_TIMESTAMP" ) */
    private $createdAt;

    /** @ORM\Column(type="datetime",columnDefinition="TIMESTAMP DEFAULT CURRENT_TIMESTAMP" ) */
    private $updatedAt;


    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return StudentEntity
     */
    public function getStudentId(): ?StudentEntity
    {
        return $this->student_id;
    }

    /**
     * @return StudentAccountEntity
     */
    public function getStudentAccountId(): ?StudentAccountEntity
    {
        return $this->student_account_id;
    }

    /**
     * @return CoursesEntity
     */
    public function getCoursesId(): ?CoursesEntity
    {
        return $this->courses_id;
    }

    /**
     * @return dateTime
     */
    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @return dateTime
     */
    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }


    /**
     * @param int
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @param StudentEntity
     */
    public function setStudentId(?StudentEntity $student_id)
    {
        $this->student_id = $student_id;
    }

    /**
     * @param StudentAccountEntity
     */
    public function setStudentAccountId(?StudentAccountEntity $student_account_id)
    {
        $this->student_account_id = $student_account_id;
    }

    /**
     * @param CoursesEntity
     */
    public function setCoursesId(?CoursesEntity $courses_id)
    {
        $this->courses_id = $courses_id;
    }

    /**
     * @param dateTime
     */
    public function setCreatedAt(\DateTimeInterface $createdAt)
    {
        $this->createdat = $createdAt;
    }

    /**
     * @param dateTime
     */
    public function setUpdatedAt(\DateTimeInterface $updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    public function jsonSerialize(): array
    {
        return [
            "id" => $this->getId(),
            "Nome" => $this->getStudentId()->getName(),
            "email" => $this->getStudentAccountId()->getEmail(),
            "Curso" => $this->getCoursesId()->getTitle(),
            "Descrição" => $this->getCoursesId()->getDecription(),
            "Data De Inicio" => $this->getCoursesId()->getInitialDate()->format('d-m-Y'),
            "Data De Fim" => $this->getCoursesId()->getFinalDate()->format('d-m-Y'),
        ];
    }
}
