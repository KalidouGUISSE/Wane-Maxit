<?php
namespace App\Core\Middlewares;

use App\Core\Session;

class Auth {
    public function __invoke()
    {
        $session = Session::getInstance();
        $user = $session->get('user');

        if (!$user) {
            header('Location: /'); // rediriger vers page de connexion
            exit;
        }
    }
}
