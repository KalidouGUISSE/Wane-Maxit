<?php
namespace App\Core\Validator\Rules;

interface ValidationRuleInterface {
    public function validate(string $key, $value, array &$errors): void;
}
