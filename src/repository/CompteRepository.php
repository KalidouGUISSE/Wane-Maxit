<?php
namespace Src\repository;

use PDO;
use PDOException;
use App\Core\Database;

class CompteRepository {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = Database::getConnection();
    }

    public function insert($telephone, $solde, $typeCompte, $userId)
    {
        try {
            // Début de transaction
            // $this->pdo->beginTransaction();

            $sqlCompte = "INSERT INTO compte (numero_du_compte, solde, type_compte, user_id)
                          VALUES (:numero_du_compte, :solde, :type_compte, :user_id)";
            
            $stmtCompte = $this->pdo->prepare($sqlCompte);

            $solde = 0;
            $typeCompte = 'principal';

            $stmtCompte->bindParam(':numero_du_compte', $telephone);
            $stmtCompte->bindParam(':solde', $solde);
            $stmtCompte->bindParam(':type_compte', $typeCompte);
            $stmtCompte->bindParam(':user_id', $userId);
            
            $stmtCompte->execute();
            
            // var_dump(" compte");die;
            // $this->pdo->commit();

        } catch (PDOException $e) {
            // En cas d’erreur, rollback (annule tout)
            $this->pdo->rollBack();
            throw $e;
        }
    }
}
