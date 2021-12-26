<?php

namespace App\Model;

use \DateTimeImmutable;
use App\Model\Status;
use App\Model\User;
use App\Exception\InvalidFactTypeException;

class Fact 
{
    public const ALLOWED_TYPES = [self::CAT, self::DOG];
    
    public const CAT = 'cat';
    
    public const DOG = 'dog';
    
    protected ?User $author;
    
    protected DateTimeImmutable $createdAt;
       
    protected string $id;
    
    protected Status $status;
    
    protected string $text;
    
    protected string $type;
    
    protected ?DateTimeImmutable $updatedAt;
    
    protected string $user;
    
    public function getAuthor(): ?User 
    {
        return $this->author;
    }
    
    public function getCreatedAt(): DateTimeImmutable 
    {
        return $this->createdAt;
    }

    public function getId(): string 
    {
        return $this->id;
    }
    
    public function getStatus(): Status 
    {
        return $this->status;
    }
    
    public function getText(): string 
    {
        return $this->text;
    }
    
    public function getType(): string 
    {
        return $this->type;
    }
    
    public function getUpdatedAt(): ?DateTimeImmutable 
    {
        return $this->updatedAt;
    }
    
    public function getUser(): string 
    {
        return $this->user;
    }
    
    public function setAuthor(?User $author) 
    {
        $this->author = $author;
        return $this;
    }
    
    public function setCreatedAt(DateTimeImmutable $createdAt) 
    {
        $this->createdAt = $createdAt;
        return $this;
    }
    
    public function setId(string $id) 
    {
        $this->id = $id;
        return $this;
    }
    
    public function setStatus(Status $status) 
    {
        $this->status = $status;
        return $this;
    }
    
    public function setText(string $text) 
    {
        $this->text = $text;
        return $this;
    }
    
    public function setType(string $type) 
    {
    
        if(!in_array($type, self::ALLOWED_TYPES)){
            throw new InvalidFactTypeException('The type is not allowed');
        } else {
            
             $this->type = $type;
        }
        return $this;
    }
    
    public function setUpdatedAt(?DateTimeImmutable $updatedAt) 
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    public function setUser(string $user) 
    {
        $this->user = $user;
        return $this;
    }

}