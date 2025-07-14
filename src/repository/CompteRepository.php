<?php
namespace Src\repository;

use PDO;
use PDOException;
use App\Core\Database;
use App\Core\App;

class CompteRepository {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = Database::getConnection();
    }

    public function insert(string $telephone, int $userId): void {
        try {
            $sql = "INSERT INTO compte (numero_du_compte, solde, type_compte, user_id)
                    VALUES (:numero_du_compte, :solde, :type_compte, :user_id)";

            $stmt = $this->pdo->prepare($sql);
            $solde = 0;
            $typeCompte = 'principal';

            $stmt->bindParam(':numero_du_compte', $telephone);
            $stmt->bindParam(':solde', $solde);
            $stmt->bindParam(':type_compte', $typeCompte);
            $stmt->bindParam(':user_id', $userId);

            $stmt->execute();
        } catch (PDOException $e) {
            $this->pdo->rollBack();
            throw $e;
            // $this->pdo->rollBack();
            // var_dump('Erreur CompteRepository:', $e->getMessage()); // 👈 ajoute ceci
            // die;
        }
    }
}
