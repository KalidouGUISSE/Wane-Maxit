<?php
namespace Src\Entity;

enum TypeTransaction: string
{
    case DEPOT = 'depot';
    case RETRAIT = 'retrait';
    case PAIEMENT = 'paiement';

    // Exemple de méthode utilitaire
    public static function fromString(string $value): ?self {
        return match($value) {
            'depot' => self::DEPOT,
            'retrait' => self::RETRAIT,
            'paiement' => self::PAIEMENT,
            default => null,
        };
    }

    public static function values(): array {
        return array_map(fn($case) => $case->value, self::cases());
    }
}
