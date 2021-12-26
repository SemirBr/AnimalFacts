<?php

class ViewTest extends PHPUnit\Framework\TestCase 
{
    
    public function testCreateViewByConstructor()
    {
 	$view = new View('views');	
        $this->assertEquals('views', $view->viewDirectory);
    }
   
    public function testRenderMethodWithExistingView()
    {
 	$view = new View('views');	
      
    }
    
  
    public function testRenderMethodWithNonExistingView()
    {
 	$view = new View('views');	
   
    }
}
