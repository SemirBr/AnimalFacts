<?php

namespace App\View;

class View 
{
    //Path to view directory
    protected string $viewDirectory;
    
    public function __construct(string $viewDirectory) 
    {
        $this->viewDirectory = $viewDirectory;
    }
    public function render(string $viewName, array $viewModel):string 
    {   
        $filePath = $this->viewDirectory.'/'.$viewName.'.php';
        if(file_exists($filePath)){
            extract($viewModel);
            ob_start();
            include $filePath;
            $renderedView = ob_get_clean();
        }else {
            $renderedView = $this->render('error/no_view',$viewModel ); 
        }
        return $renderedView;
    }
}