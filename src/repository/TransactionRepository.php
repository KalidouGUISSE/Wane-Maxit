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
}