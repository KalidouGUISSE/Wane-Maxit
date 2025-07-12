<?php
namespace Src\repository;

use PDO;
use PDOException;
use App\Core\Database;
use App\Core\Abstract\AbstractRepository;

class UtilisateurRepository{

    public function __construct() {
        $this->pdo = Database::getConnection();
    }  
    
    public function insert(string $password, string $telephone, string $nci, string $nom, string $prenom, string $adresse, ?array $photoRecto, ?array $photoVerso): int {
        try {
            // Définir le répertoire de stockage des fichiers
            $uploadDir = __DIR__ . '/../../public/uploads/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
    
            // Générer des noms uniques pour éviter les collisions
            $photoRectoName = uniqid('recto_') . '_' . basename($photoRecto['name']);
            $photoVersoName = uniqid('verso_') . '_' . basename($photoVerso['name']);
    
            // Déplacer les fichiers vers le dossier de destination
            move_uploaded_file($photoRecto['tmp_name'], $uploadDir . $photoRectoName);
            move_uploaded_file($photoVerso['tmp_name'], $uploadDir . $photoVersoName);
    
            // Requête d’insertion
            $sqlUser = "INSERT INTO utilisateur (nom, prenom, num_tel, nci, adresse, photo_recto, photo_verso, password)
                        VALUES (:nom, :prenom, :telephone, :nci, :adresse, :photo_recto, :photo_verso, :password)";
    
            $stmtUser = $this->pdo->prepare($sqlUser);
            $stmtUser->bindParam(':nom', $nom);
            $stmtUser->bindParam(':prenom', $prenom);
            $stmtUser->bindParam(':telephone', $telephone);
            $stmtUser->bindParam(':nci', $nci);
            $stmtUser->bindParam(':adresse', $adresse);
            $stmtUser->bindParam(':photo_recto', $photoRectoName);
            $stmtUser->bindParam(':photo_verso', $photoVersoName);
            $stmtUser->bindParam(':password', $password);
            // var_dump('')
            $stmtUser->execute();
    
            return (int) $this->pdo->lastInsertId();
    
        } catch (PDOException $e) {
            var_dump('repositorie',$e);die;
            throw new \Exception("Erreur lors de l'insertion de l'utilisateur : " . $e->getMessage());
        }
    }
    

    public function existsBy(string $column, $value): ?array {
        $allowedColumns = ['nci', 'num_tel'];
    
        if (!in_array($column, $allowedColumns)) {
            throw new \InvalidArgumentException("Colonne non autorisée : $column");
        }
    
        $sql = "SELECT * FROM utilisateur WHERE $column = :value LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['value' => $value]);
    
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result ?: null;
    }

    public function validExistsBy(string $column, $value): bool {
        return $this->selectBy($column, $value) !== null;
    }


    public function selectAll(){}
    // public function selectBy(array $filter){}
    // abstract public function insert();
    public function update(){}
    public function delete(){}
    public function selectById(){}
}