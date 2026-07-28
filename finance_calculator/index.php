<?php


require_once __DIR__ . '/validator/validator.php';
require_once __DIR__ . '/response/response.php';
require_once __DIR__ . '/main_logic/finance_service.php';
require_once __DIR__ . '/handlers/simple_interest_handler.php';
require_once __DIR__ . '/handlers/compound_interest_handler.php';

// method and url detect
$method = $_SERVER['REQUEST_METHOD'];

$url    = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$url    = str_replace('/finance_calculator/', '', $url);
$url    = trim($url, '/');   

// route
$routes = [
    'POST' => [
        'api/simple-interest' => [SimpleInterestHandler::class, 'calculate'],
        'api/compound-interest' => [CompoundInterestHandler::class, 'calculate'],
    ],
];


$response = new Response();

if (!isset($routes[$method])) {
    $response->methodNotAllowed("Method '{$method}' is not allowed");
}

if (!isset($routes[$method][$url])) {
    $response->notFound("Route '{$url}' not found. ");
}

[$handlerClass, $handlerMethod] = $routes[$method][$url];


$handler = new $handlerClass();
$handler->$handlerMethod();


