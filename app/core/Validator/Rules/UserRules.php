<?php
namespace App\Core\Validator\Rules;

use Src\service\SecuriteService;

class UserRules
{
    private static function baseRules(): array {
        $checker = new SecuriteService();

        return [
            'nom'                       => [new RequiredRule()],
            'prenom'                    => [new RequiredRule()],
            'password'                  => [new RequiredRule()],
            'adresse'                   => [new RequiredRule()],
            'photo_recto'               => [new FileRequiredRule()],
            'photo_verso'               => [new FileRequiredRule()],
            'password_confirmation'     => [new Compare('password')],
            'telephone'                 => [
                new RequiredRule(),
                new SenegalPhoneRule(),
                new UniqueRule('num_tel', $checker, 'Ce numéro est déjà utilisé.')
            ],
            'nci'                       => [
                new RequiredRule(),
                new NciRule(),
                new UniqueRule('nci', $checker, 'Ce NCI est déjà utilisé.')
            ],
        ];
    }

    public static function getRules(): array {
        return self::baseRules();
    }
    /**
     * Retourne les règles uniquement pour les champs demandés,
     * en excluant certaines règles si besoin.
     *
     * @param array $fields Champs à valider (ex. ['telephone', 'password'])
     * @param array $excludeTypes Types de règles à exclure (ex. [UniqueRule::class])
     * @return array
     */
    public static function getRulesFor(array $fields, array $excludeTypes = []): array {
        $all = self::baseRules();
        $filtered = [];

        foreach ($fields as $field) {
            if (isset($all[$field])) {
                $filtered[$field] = array_filter($all[$field], function ($rule) use ($excludeTypes) {
                    foreach ($excludeTypes as $excluded) {
                        if ($rule instanceof $excluded) {
                            return false;
                        }
                    }
                    return true;
                });
            }
        }

        return $filtered;
    }
}