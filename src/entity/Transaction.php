<?php
namespace Src\Entity;

use Src\Entity\TypeTransaction;
class Transaction extends AbstractEntity {
    private int $id;
    private float $montant;
    private string $numeroDestinataire;
    private \DateTime $date;
    private Compte $compte;

    /** @var TypeTransaction */
    private TypeTransaction $typeTransaction;

    public function __construct( \DateTime $date, Compte $compte, TypeTransaction $typeTransaction) {
        $this->date            = $date;
        $this->compte          = $compte;
        $this->typeTransaction = $typeTransaction;
    }



    // Getters et setters (exemple)
    public function getTypeTransaction(): TypeTransaction {
        return $this->typeTransaction;
        }

     public function setTypeTransaction(TypeTransaction $typeTransaction): void {
        $this->typeTransaction = $typeTransaction;
     }

        /**
         * Get the value of id
         */ 
        public function getId()
        {
            return $this->id;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setId($id)
        {
            $this->id = $id;

            return $this;
        }

        /**
         * Get the value of montant
         */ 
        public function getMontant()
        {
            return $this->montant;
        }

        /**
         * Set the value of montant
         *
         * @return  self
         */ 
        public function setMontant($montant)
        {
            $this->montant = $montant;

            return $this;
        }

        /**
         * Get the value of numeroDestinataire
         */ 
        public function getNumeroDestinataire()
        {
            return $this->numeroDestinataire;
        }

        /**
         * Set the value of numeroDestinataire
         *
         * @return  self
         */ 
        public function setNumeroDestinataire($numeroDestinataire)
        {
            $this->numeroDestinataire = $numeroDestinataire;

            return $this;
        }

        /**
         * Get the value of date
         */ 
        public function getDate()
        {
            return $this->date;
        }

        /**
         * Set the value of date
         *
         * @return  self
         */ 
        public function setDate($date)
        {
            $this->date = $date;

            return $this;
        }

        /**
         * Get the value of compte
         */ 
        public function getCompte()
        {
            return $this->compte;
        }

        /**
         * Set the value of compte
         *
         * @return  self
         */ 
        public function setCompte($compte)
        {
            $this->compte = $compte;

            return $this;
        }
}
