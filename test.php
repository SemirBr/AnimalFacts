<?php

use App\View\View;
use App\Exceprion;
use App\Repository\FactRepository;
use Psr\Http\ClientInterface;
use App\Model\Fact;

require_once './vendor/autoload.php';
$view = new View('views');
$view->render('layout', ['content' => 'html', 'title' => 'title']);
