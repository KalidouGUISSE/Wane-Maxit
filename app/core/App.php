<?php
namespace App\Core;

use Symfony\Component\Yaml\Yaml;
use App\Core\Validator\Validator;

class App {
    private static ?App $instance = null;
    private array $dependencies = [];

    private function __construct() {
        $configPath = __DIR__ . '/../config/service.yaml';
        $config = Yaml::parseFile($configPath);

        foreach ($config as $category => $items) {
            $this->dependencies[$category] = [];

            foreach ($items as $key => $className) {
                if (class_exists($className)) {
                    // Cas particuliers pour les singletons
                    if (method_exists($className, 'getInstance')) {
                        $this->dependencies[$category][$key] = $className::getInstance();
                    } else {
                        $this->dependencies[$category][$key] = new $className();
                    }
                } else {
                    var_dump("Classe '$className' non trouvée pour la dépendance '$key' dans '$category'.");die;
                    throw new \Exception("Classe '$className' non trouvée pour la dépendance '$key' dans '$category'.");
                }
            }
        }
    }

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
