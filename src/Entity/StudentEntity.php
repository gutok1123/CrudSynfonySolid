<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StudentEntityRepository::class)
 */
class StudentEntity
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

    public function getId(): ?int
    {
        return $this->id;
    }
}
