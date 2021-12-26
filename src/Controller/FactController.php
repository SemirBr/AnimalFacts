<?php

namespace App\Controller;
use App\View\View;
use App\Repository\FactRepository;
use App\Model\FactCollection;

class FactController 
{
    protected View $view;
    
    protected FactRepository $repository;

  
    public function __construct(View $view, FactRepository $repository) 
    {
        $this->view = $view;
        $this->repository = $repository;
    }

    public function single(string $id): string 
    {
        $fact = $this->repository->getFact($id);
        $renderView = $this->view->render('fact/single', ['fact'=>$fact]);
        return $renderView;
    }
    
     public function list(int $amount, string $type): string 
    {
        $list = $this->repository->getRandomList($amount, $type);
        $renderView = $this->view->render('fact/list', ['list'=>$list]);
        return $renderView;
    }

}