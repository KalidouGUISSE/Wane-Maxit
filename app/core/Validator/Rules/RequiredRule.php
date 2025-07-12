<?php
namespace App\Core\Validator\Rules;

class RequiredRule implements ValidationRuleInterface {
    private string $message;

    public function __construct(string $message = "Ce champ est obligatoire.") {
        $this->message = $message;
    }

    public function validate(string $key, $value, array &$errors): void {
        if (empty(trim($value))) {
            $errors[$key][] = $this->message;
        }
    }
}


