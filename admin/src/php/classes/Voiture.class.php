<?php


class Voiture {

    public $voiture_id;
    public $marque;
    public $modele;
    public $annee;
    public $prix;
    public $km;
    public $description;
    public $image;
    public $status;
    public $cat_id;


    public function __construct($id, $marque, $modele, $annee, $prix, $km, $desc, $img, $status, $cat) {
        $this->voiture_id = $id;
        $this->marque = $marque;
        $this->modele = $modele;
        $this->annee = $annee;
        $this->prix = $prix;
        $this->km = $km;
        $this->description = $desc;
        $this->image = $img;
        $this->status = $status;
        $this->cat_id = $cat;
    }
}
?>