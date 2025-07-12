<?php
namespace App\Core\Validator\Rules;

class SenegalPhoneRule implements ValidationRuleInterface {
    private string $message;

    public function __construct(string $message = "Numéro de téléphone invalide.") {
        $this->message = $message;
    }

    public function validate(string $key, $value, array &$errors): void {
        if (!preg_match('/^(77|78|70|76|75)[0-9]{7}$/', $value)) {
            $errors[$key][] = $this->message;
        }
    }
}
