<?php

namespace App\Entity;

use Doctrine\DBAL\Types\DateType;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StudentEntityRepository::class)
 */
class StudentEntity  implements \JsonSerializable
{
     /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    
    /** @ORM\Column(type="string", length=255) */
     private $name;
    
   /** @ORM\Column(type="string", length=255, unique=true) */
    private $email;

   
    /** @ORM\Column(type="date") */
    private $birthDay;

    /** @ORM\Column(type="string", length=50, nullable=true) */
    private $status;

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
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @return datetime
     */
    public function getBirthDay() :  ?\DateTimeInterface
    {
        return $this->birthDay;
    }
    
    /**
     * @return string
     */
    public function getStatus(): ?string
    {
        return $this->status;
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
     * @param int $id
     */
    public function setId(int $id)
    {
      $this->id = $id;
    }
    
    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status)
    {
        $this->status = $status;
    }

    /**
     * @param datetime $birthDay
     */
    public function setBirthDay(\DateTimeInterface $birthDay)
    { 
        
        $this->birthDay = $birthDay;
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
    
    /**
     * @return array
     */
    public function jsonSerialize() : array
    {
        return [
            "id" => $this->getId(),
            "name" => $this->getName(),
            "status" => $this->getStatus(),
            "birthDay" =>$this->getBirthDay()->format('d-m-Y'),
            "email" => $this->getEmail(),
            "created_at" => $this->getCreatedAt(),
            "updated_at"=> $this->getUpdatedAt()
        ];
    }
}
