<?php
namespace Src\service;
use Src\repository\UtilisateurRepository;

class UtilisateurService{
    private UtilisateurRepository $utilisateurRepository;

    public function __construct(){
        $this->utilisateurRepository = new UtilisateurRepository();
    }

    public function creerClient($telephone, $nci, $nom, $prenom, $adresse, $photoRecto, $photoVerso) {
        return $this->utilisateurRepository->insert($telephone, $nci, $nom, $prenom, $adresse, $photoRecto, $photoVerso);
    }

    public function verifierConnexion(string $telephone, string $password): array|null {
        $user = $this->utilisateurRepository->checkCredentials($telephone, $password);
        return $user;
    }
}