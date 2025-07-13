<?php
require_once __DIR__ . '/../vendor/autoload.php'; 
use Src\controller\SecuritieController;
use Src\controller\CompteController;
use Src\controller\TransactionController;
use Src\controller\UtilisateurController;

$routes = [
    '/' => ['controller' => SecuritieController::class, 'action' => 'connection'],
    '/deconnexion' => ['controller' => SecuritieController::class, 'action' => 'deconnexion'],
    '/motdepasse' => ['controller' => SecuritieController::class, 'action' => 'motdepasse'],
    '/creer' => ['controller' => SecuritieController::class, 'action' => 'creer' ],
    '/creerCompte' => ['controller' => SecuritieController::class, 'action' => 'creerCompte' ],
    '/listerTransaction' => ['controller' => UtilisateurController::class, 'action' => 'listerTransaction','middleware' => ['auth'] ]
];
