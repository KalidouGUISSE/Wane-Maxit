<?php
require_once __DIR__ . '/../vendor/autoload.php'; 
use Src\controller\SecuritieController;
use Src\controller\CompteController;



$routes = [
    '/' => ['controller' => SecuritieController::class, 'action' => 'connection'],
    '/creerCompte' => ['controller' => SecuritieController::class, 'action' => 'creerCompte' ]
];
