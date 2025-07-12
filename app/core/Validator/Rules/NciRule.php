<?php
namespace App\Core\Validator\Rules;

class NciRule implements ValidationRuleInterface {
    private string $message;

    public function __construct(string $message = "Numéro de carte d'identité invalide.") {
        $this->message = $message;
    }

    public function validate(string $key, $value, array &$errors): void {
        if (!preg_match('/^[1-2][0-9]{12}$/', $value)) {
            $errors[$key][] = $this->message;
        }
    }
}
