<?php


class VoitureDAO
{
    private $cnx;


    public function __construct($cnx)
    {
        $this->cnx = $cnx;
    }


    public function getToutesLesVoitures()
    {
        $sql = "SELECT * FROM voiture ORDER BY voiture_id DESC";

        try {
            $stmt = $this->cnx->prepare($sql);
            $stmt->execute();

            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $listeVoitures = [];


            foreach ($data as $row) {
                $listeVoitures[] = new Voiture(
                    $row['voiture_id'],
                    $row['marque'],
                    $row['modele'],
                    $row['annee'],
                    $row['prix'],
                    $row['km'],
                    $row['description'],
                    $row['image'],
                    $row['status'],
                    $row['cat_id']
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
}
?>