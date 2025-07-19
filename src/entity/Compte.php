<?php
namespace Src\Entity;

class Compte{
    private string $id;
    private string $numeroDuCompte;
    private string $solde;
    private string $statut;    
    private Utilisateur $utilisateur;
    private array $tansaction = [];
}