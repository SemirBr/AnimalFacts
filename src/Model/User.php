<?php

namespace App\Model;

use App\Exception\InvalidUserNamesException;

class User 
{
   
    protected string $id;
    
    protected  string $photo;

    protected array $name;

    public function __construct(string $id, string $photo, array $name) 
    {
        $this->id = $id;
        $this->photo = $photo;
        $this->name = $name;
    }
    
    public function getFirstName(): string 
    {  
        $firstName = $this->name['first'];
        return $firstName;
    } 
    
    public function getFullName(): string 
    {
        $fullName = implode(' ',$this->name);
        return $fullName;
    } 

    public function getId(): string 
    {
        return $this->id;
    }
    
    public function getLastName(): string 
    {
         $lastName = $this->name['last'];
        return $lastName;
    } 
    
    public function getName(): array 
    {
        return $this->name;
    }
    
    public function getPhoto(): string 
    {
        return $this->photo;
    }

    public function setId(string $id) 
    {
        $this->id = $id;
        return $this;
    }

    public function setName(array $name) 
    {
    
        if(!array_key_exists('first', $name)&&
                (!array_key_exists('last', $name))) {
            throw new InvalidUserNamesException('Invalid name');
        }else {
            $this->name = $name;
        }
        return $this;
    }
    
    public function setPhoto(string $photo) 
    {
        $this->photo = $photo;
        return $this;
    }

     
}