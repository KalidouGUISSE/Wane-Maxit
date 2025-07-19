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
    '/seConnecter' => ['controller' => UtilisateurController::class, 'action' => 'seConnecter'],
    '/listerTransaction' => ['controller' => TransactionController::class, 'action' => 'listerTransaction','middleware' => ['auth'] ],
    '/debutdepot' => ['controller' => SecuritieController::class, 'action' => 'debutdepot','middleware' => ['auth'] ],
    '/depot' =>  ['controller' => SecuritieController::class, 'action' => 'depot','middleware' => ['auth'] ],
];
