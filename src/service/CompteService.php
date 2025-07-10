<?php
namespace Src\service;
use Src\repository\CompteRepository;

class CompteService{
    private CompteRepository $compteRepository;

    public function __construct(){
        $this->compteRepository = new CompteRepository();
    }

    public function creerCompte($telephone, $solde, $typeCompte, $userId){
        // $this->compteRepository->insert('77234',20000,'principal',1);
        $this->compteRepository->insert($telephone, $nci, $nom, $prenom, $adresse, $photoRecto, $photoVerso);

    }

}