<?php


class Utilisateur {
    public $user_id;
    public $nom;
    public $email;
    public $mot_de_passe;
    public $role;

    public function __construct($id, $nom, $email, $mdp, $role) {
        $this->user_id = $id;
        $this->nom = $nom;
        $this->email = $email;
        $this->mot_de_passe = $mdp;
        $this->role = $role;
    }
}
?>