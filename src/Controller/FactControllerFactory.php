<?php

namespace App\Controller;

use App\View\View;
use \App\Repository\FactRepository;
use GuzzleHttp\Client;

class FactControllerFactory 
{
    public static function create(View $view): FactController
    {
        $factController = new FactController($view, new FactRepository
                (BASE_URL, new Client()));
        return $factController;
    }
}