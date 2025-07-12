<?php
namespace App\Core;
use App\Core\Validator\Validator;

class App {
    private static ?App $instance = null;
    private array $dependencies;

    private function __construct() {
        $this->dependencies = [
            "core" => [
                "router"     => new Router(),
                // "database"   => Database::getInstance(),
                "validator"  => Validator::getInstance(),
                "session"    => Session::getInstance(),
            ],
            "services" => [],
            "repositories" => [],
        ];
    }

    // Singleton - retourne l’instance de App
    public static function getInstance(): App {
        if (self::$instance === null) {
            self::$instance = new App();
        }
        return self::$instance;
    }

    // Retourne toutes les dépendances ou une dépendance précise
    public static function getDependencie(string $category = null, string $key = null) {
        $app = self::getInstance();

        if ($category === null) {
            return $app->dependencies;
        }

        if (!isset($app->dependencies[$category])) {
            throw new \Exception("Catégorie de dépendance '$category' introuvable.");
        }

        if ($key === null) {
            return $app->dependencies[$category];
        }

        if (!isset($app->dependencies[$category][$key])) {
            throw new \Exception("Clé de dépendance '$key' introuvable dans '$category'.");
        }

        return $app->dependencies[$category][$key];
    }
}

        // $validator = $validator->getInstance();
        // $validator = Validator::getInstance();
        // $validator = App::getDependencie('core', 'validator');

        // Obtenir toutes les dépendances core :
        // $core = App::getDependencie('core');
        // Obtenir toutes les dépendances :
        // $toutes = App::getDependencie();
