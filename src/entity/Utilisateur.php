<?php
namespace Src\Entity;

class Utilisateur{
    private int $id;
    private string $numeroTelephone;
    private string $nci;
    private string $photoRecto;
    private string $photoVerso;
    private string $nom;
    private string $prenom;
    private string $qdresse;
    private array $compte = [];

}