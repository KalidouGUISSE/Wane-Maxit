<?php
namespace App\Core\Validator\Rules;
// use App\Core\Validator\Rules\UniqueRule;
use Src\service\SecuriteService;

// use App\Core\Validator\Rules\RequiredRule;
// use App\Core\Validator\Rules\SenegalPhoneRule;
// use App\Core\Validator\Rules\NciRule;
// use App\Core\Validator\Rules\FileRequiredRule;

class UserRules
{
    public static function getRules(): array {
        $checker = new SecuriteService(); // Injecte le service une seule fois    
        return [
            'nom'                       => [new RequiredRule()],
            'prenom'                    => [new RequiredRule()],
            'telephone'                 => [new RequiredRule(), new SenegalPhoneRule(),new UniqueRule('num_tel', $checker, 'Ce numéro est déjà utilisé.')],
            'nci'                       => [new RequiredRule(), new NciRule(), new UniqueRule('nci', $checker, 'Ce NCI est déjà utilisé.')],
            'password'                  => [new RequiredRule()],
            'adresse'                   => [new RequiredRule()],
            'photo_recto'               => [new FileRequiredRule()],
            'photo_verso'               => [new FileRequiredRule()],
            'password_confirmation'     => [new Compare('password')]
        ];
    }
}