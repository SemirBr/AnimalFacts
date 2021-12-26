<?php

namespace App\Model;

use ArrayObject;
use App\Exception\InvalidCollectionObjectException;

class FactCollection extends ArrayObject
{
    protected array $factCollection;

    public function offsetSet(mixed $index, mixed $newval) 
    {
        try{
            $this->ensureFactObject($newval);
            $factCollection = new ArrayObject();
            parent::offsetSet($index, $newval);
        } catch (InvalidCollectionObjectException $ex) {
            $ex->getMessage();
        }     
    }

     protected function ensureFactObject(object $object) 
    {
        if(!($object instanceof Fact)){
            throw new InvalidCollectionObjectException(
                    "Object of disallowed class is set to the collection");
        }
    }
}
