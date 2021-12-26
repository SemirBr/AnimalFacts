<?php

require_once './vendor/autoload.php';

use App\Model\Fact;
use App\View\View;
use App\Controller\FactControllerFactory;

define('DEFAULT_AMOUNT', 10);
define('DEFAULT_TYPE', Fact::CAT);
define('BASE_URL', 'https://cat-fact.herokuapp.com');

$view = new View('views');
$html = '';
try {
    if (isset($_GET['id'])) {
        $args = [$_GET['id']];
        $method = 'single';
        $title = 'View Single Fact';
    } else {
        $args = [
            (int) ($_GET['amount'] ?? DEFAULT_AMOUNT),
            $_GET['type'] ?? DEFAULT_TYPE
        ];
        $method = 'list';
        $title = 'View Fact List';
    }
    $controller = FactControllerFactory::create($view);
    $html = call_user_func_array([$controller, $method], $args);
} catch (Exception $ex) {
    $title = 'Exception was thrown';
    $html = $view->render('error/exception', ['exception' => $ex]);
} finally {
    echo $view->render('layout', ['content' => $html, 'title' => $title]);
}