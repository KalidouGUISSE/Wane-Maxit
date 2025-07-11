<?php
namespace Src\service;
use Src\repository\CompteRepository;
use Src\repository\UtilisateurRepository;
use App\Core\Database;

class SecuriteService{

    private UtilisateurRepository $utilisateurRepository;
    private CompteRepository $compteRepository;
    
    public function __construct(){
        $this->utilisateurRepository = new UtilisateurRepository();
        $this->compteRepository = new CompteRepository();
    }

    public function creerUtilisateurEtCompte(
        string $password,
        string $telephone,
        string $nci,
        string $nom,
        string $prenom,
        string $adresse,
        ?array $photoRecto,
        ?array $photoVerso
    ): void {
        $pdo = Database::getConnection();

        try {
            $pdo->beginTransaction();
            $userId = $this->utilisateurRepository->insert($password, $telephone, $nci, $nom, $prenom, $adresse, $photoRecto, $photoVerso);
            $this->compteRepository->insert($telephone, $userId);
            $pdo->commit();
        } catch (\PDOException $e) {
            $pdo->rollBack();
            throw new \Exception("Erreur lors de la création du compte utilisateur : " . $e->getMessage());
        }
    }
}