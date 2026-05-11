<?php
class Reservation {
    public $voiture_id;
    public $utilisateur_id;

    public function __construct($voiture_id, $utilisateur_id) {
        $this->voiture_id = $voiture_id;
        $this->utilisateur_id = $utilisateur_id;
    }
}