<?php


class VoitureDAO
{
    private $cnx;


    public function __construct($cnx)
    {
        $this->cnx = $cnx;
    }



    public function getToutesLesVoitures($recherche = "", $tri = "")
    {

        $sql = "SELECT * FROM voiture WHERE 1=1";
        $params = [];


        if (!empty($recherche)) {
            $sql .= " AND (marque ILIKE :recherche OR modele ILIKE :recherche)";
            $params[':recherche'] = '%' . $recherche . '%';
        }

        if ($tri === 'prix_asc') {
            $sql .= " ORDER BY prix ASC";
        } elseif ($tri === 'prix_desc') {
            $sql .= " ORDER BY prix DESC";
        } else {
            $sql .= " ORDER BY voiture_id DESC";
        }

        try {
            $stmt = $this->cnx->prepare($sql);


            foreach ($params as $key => &$val) {
                $stmt->bindParam($key, $val);
            }

            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $listeVoitures = [];
            foreach ($data as $row) {
                $listeVoitures[] = new Voiture(
                    $row['voiture_id'], $row['marque'], $row['modele'],
                    $row['annee'], $row['prix'], $row['km'],
                    $row['description'], $row['image'], $row['status'], $row['cat_id']
                );
            }
            return $listeVoitures;

        } catch (PDOException $e) {
            print "Erreur lors de la récupération des voitures : " . $e->getMessage();
            return null;
        }
    }


    public function addVoiture($marque, $modele, $annee, $prix, $km, $description, $image, $status, $cat_id)
    {

        $sql = "SELECT ajout_voiture(:marque, :modele, :annee, :prix, :km, :description, :image, :status, :cat_id) AS retour";

        try {
            $stmt = $this->cnx->prepare($sql);


            $stmt->bindParam(':marque', $marque);
            $stmt->bindParam(':modele', $modele);
            $stmt->bindParam(':annee', $annee);
            $stmt->bindParam(':prix', $prix);
            $stmt->bindParam(':km', $km);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':image', $image);

            $stmt->bindParam(':status', $status, PDO::PARAM_BOOL);
            $stmt->bindParam(':cat_id', $cat_id);

            $stmt->execute();


            return $stmt->fetchColumn(0);

        } catch (PDOException $e) {
            print "Erreur lors de l'ajout de la voiture : " . $e->getMessage();
            return null;
        }
    }

    public function getVoitureById($id) {
        $sql = "SELECT * FROM voiture WHERE voiture_id = :id";
        try {
            $stmt = $this->cnx->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                return new Voiture($row['voiture_id'], $row['marque'], $row['modele'], $row['annee'], $row['prix'], $row['km'], $row['description'], $row['image'], $row['status'], $row['cat_id']);
            }
            return null;
        } catch (PDOException $e) { return null; }
    }


    public function deleteVoiture($id) {
        $sql = "SELECT supprimer_voiture(:id)";
        try {
            $stmt = $this->cnx->prepare($sql);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch (PDOException $e) { return false; }
    }


    public function updateVoiture($id, $marque, $modele, $annee, $prix, $km, $description, $image, $status, $cat_id) {
        $sql = "SELECT modifier_voiture(:id, :marque, :modele, :annee, :prix, :km, :description, :image, :status, :cat_id)";
        try {
            $stmt = $this->cnx->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':marque', $marque);
            $stmt->bindParam(':modele', $modele);
            $stmt->bindParam(':annee', $annee);
            $stmt->bindParam(':prix', $prix);
            $stmt->bindParam(':km', $km);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':image', $image);
            $stmt->bindParam(':status', $status, PDO::PARAM_BOOL);
            $stmt->bindParam(':cat_id', $cat_id);
            return $stmt->execute();
        } catch (PDOException $e) { return false; }
    }
}
?>