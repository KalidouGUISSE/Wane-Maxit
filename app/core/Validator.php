<?php
namespace App\Core;

class Validator {
    private static ?Validator $instance = null;
    private static array $errors = [];

    private function __construct() {}

    public static function getInstance():Validator{
        if (self::$instance === null) {
            self::$instance = new Validator();
        }
        return self::$instance;
    }

    /**
     * Vérifie si une valeur est vide
     */
    public function isEmpty(string $key, $value, string $message = "Ce champ est obligatoire.") {
        if (empty(trim($value))) {
            self::addError($key, $message);
        }
    }

    /**
     * Vérifie si une valeur est un email valide
     */
    public function isEmail(string $key, $value, string $message = "Email invalide.") {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            self::addError($key, $message);
        }
    }

    /**
     * Ajoute une erreur à la liste
     */
    public function addError(string $key, string $message) {
        self::$errors[$key][] = $message;
    }

    /**
     * Retourne toutes les erreurs
     */
    public function getErrors(): array {
        return self::$errors;
    }

    /**
     * Indique s’il y a des erreurs ou non
     */
    public function isValid(): bool {
        return empty(self::$errors);
    }
    
}
