<?php
namespace App\Core\Validator\Rules;

class FileRequiredRule implements ValidationRuleInterface {
    private string $message;

    public function __construct(string $message = "Ce fichier est obligatoire.") {
        $this->message = $message;
    }

    public function validate(string $key, $value, array &$errors): void {
        if (!isset($_FILES[$key]) || $_FILES[$key]['error'] !== 0) {
            $errors[$key][] = $this->message;
        }
    }
}
