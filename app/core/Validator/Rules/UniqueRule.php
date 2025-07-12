<?php
namespace App\Core\Validator\Rules;

use App\Core\Validator\Contracts\UniqueValueCheckerInterface;
// use App\Core\Validator\Rules\ValidationRuleInterface;

class UniqueRule implements ValidationRuleInterface {
    private string $champ;
    private string $message;
    private UniqueValueCheckerInterface $checker;

    public function __construct(
        string $champ,
        UniqueValueCheckerInterface $checker,
        string $message = "Cette valeur est déjà utilisé."
    ) {
        $this->champ = $champ;
        $this->message = $message;
        $this->checker = $checker;
    }

    public function validate(string $key, $value, array &$errors): void {
        if (!$this->checker->isUnique($this->champ, $value)) {
            $errors[$key][] = $this->message;
        }
    }
}
