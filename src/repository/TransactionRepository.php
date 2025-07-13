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

    
    public function selectById(int $userId, ?int $limit = null)
    {
        $sql = "
            SELECT t.date, t.type_transaction, t.compte_id, c.user_id, t.tarif, t.numero_destinataire 
            FROM transaction t
            RIGHT JOIN compte c ON t.compte_id = c.id
            JOIN utilisateur u ON c.user_id = u.id
            WHERE c.statut = 'actif' AND c.user_id = :user_id
            ORDER BY t.date DESC
        ";
    
        if ($limit !== null) {
            $sql .= " LIMIT :limit";
        }
    
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':user_id', $userId, \PDO::PARAM_INT);
        
        if ($limit !== null) {
            $stmt->bindValue(':limit', $limit, \PDO::PARAM_INT);
        }
    
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    
}