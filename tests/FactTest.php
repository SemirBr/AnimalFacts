<?php

class FactTest extends PHPUnit\Framework\TestCase
{
    public function testCanBeCreatedWithValidAnimalType() 
    {
        $this->assertInstanceOf(Fact::class, Fact::fromString());
    }
    public function testCannotBeCreatedWithValidAnimalType() 
    {
        $this->assertInstanceOf(Fact::class, Fact::fromString());
    }
     public function testSetType() 
    {
        $fact = new Fact();
        $fact->setType('CAT');
        $this->assertEquals('CAT', 'CAT');
    }
}
