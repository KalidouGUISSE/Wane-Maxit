<?php
namespace Src\repository;

use PDO;
use PDOException;
use App\Core\Database;
use App\Core\Abstract\AbstractRepository;

class TransactionRepository extends AbstractRepository{
    private PDO $pdo;

    public function __construct() {
        $this->pdo = Database::getConnection();
    }
    public function selectAll(){
        $sql = "SELECT * FROM transaction";
        return $this->pdo->query($sql)->fetchAll();
    }
    public function selectBy(array $filter){}

    // public function selectBy(array $filter){}
    // abstract public function insert();
    public function update(){}
    public function delete(){}

    
    public function selectById(int $userId){
        // $sql = "SELECT * FROM transaction WHERE utilisateur_id = :user_id";
        $sql = "    
                SELECT t.date, t.type_transaction, t.compte_id, c.user_id, t.tarif, t.numero_destinataire from transaction t
                RIGHT JOIN compte c on t.compte_id = c.id
                JOIN utilisateur u on c.user_id = u.id
                WHERE c.statut = 'actif' and c.user_id = :user_id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}