<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass=CoursesEntityRepository::class)
 */
class CoursesEntity implements \JsonSerializable
{
    
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    
    /** @ORM\Column(type="string", length=255) */
    private $title;
    
   /** @ORM\Column(type="string", length=255) */
    private $description;
    
    /** @ORM\Column(type="date") */
    private $initialDate;
    
    /** @ORM\Column(type="date") */
    private $finalDate;
    
    
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
    public function getTitle(): ?string 
    {
        return $this->title;
    }

     /**
     * @return string
     */
    public function getDecription(): ?string 
    {
        return $this->description;
    }
    
     /**
     * @return date
     */
    public function getInitialDate(): ?string
    {
        return $this->initialDate;
    }

     /**
     * @return dateTime
     */
    public function getFinalDate(): ?string
    {
        return $this->finalDate;
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
     * @param string
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    
    /**
     * @param string
     */
    public function setDescription(string $description) 
    {
        $this->description = $description;
    }

     /**
     * @param date
     */
    public function setInitialDate(string $initialDate)
    {
        $this->initialDate = $initialDate;
    }
    
     /**
     * @param dateTime
     */
    public function setFinalDate(string $finalDate)
    {
        $this->finalDate = $finalDate;
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
            "title" => $this->getTitle(),
            "description" => $this->getDecription(),
            "initial_date" =>$this->getInitialDate(),
            "final_date" => $this->getFinalDate(),
            "created_at" => $this->getCreatedAt(),
            "updated_at"=> $this->getUpdatedAt()
        ];
    }
}
