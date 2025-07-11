<?php
namespace App\Entity;

class Transaction {
    private Date $date;
    private Compte $compte;

    public function __construct(Date $date, Compte $compte){
        $this->date     = $date;
        $this->compte   = $compte;
    }
}