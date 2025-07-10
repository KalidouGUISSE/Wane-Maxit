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
            
            $userId = $this->utilisateurRepository->insert($telephone, $nci, $nom, $prenom, $adresse, $photoRecto, $photoVerso);
            
            $this->compteRepository->insert($telephone, 0, 'principal', $userId);
            
            $pdo->commit();
            // var_dump('kjsdjs');
            // var_dump($userId);die;
        } catch (\PDOException $e) {
            var_dump('eror');die;

            $pdo->rollBack();
            throw new \Exception("Erreur lors de la création du compte utilisateur : " . $e->getMessage());
        }
    }
}