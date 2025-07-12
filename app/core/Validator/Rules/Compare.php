<?php
namespace App\Core\Validator\Rules;

class Compare implements ValidationRuleInterface {
    private string $otherField;
    private string $message;

    public function __construct(string $otherField, string $message = "Les champs ne correspondent pas.") {
        $this->otherField = $otherField;
        $this->message = $message;
    }

    public function validate(string $key, $value, array &$errors): void {
        // Vérifie que le champ de comparaison existe dans le même tableau
        if (!isset($_POST[$this->otherField])) {
            $errors[$key][] = "Le champ à comparer '{$this->otherField}' est manquant.";
            return;
        }

        if ($value !== $_POST[$this->otherField]) {
            $errors[$key][] = $this->message;
        }
    }
}
