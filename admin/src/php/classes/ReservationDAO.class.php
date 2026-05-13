<?php
class ReservationDAO {
    private $cnx;

    public function __construct($cnx) {
        $this->cnx = $cnx;
    }

    public function getVoituresReservees($userId) {
        $sql = "SELECT v.* FROM voiture v 
                JOIN reserver r ON v.voiture_id = r.voiture_id 
                WHERE r.user_id = :userId";

        try {
            $stmt = $this->cnx->prepare($sql);
            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $liste = [];
            foreach ($data as $row) {
                $liste[] = new Voiture(
                    $row['voiture_id'], $row['marque'], $row['modele'],
                    $row['annee'], $row['prix'], $row['km'],
                    $row['description'], $row['image'], $row['status'], $row['cat_id']
                );
            }
            return $liste;
        } catch (PDOException $e) {
            return [];
        }
    }

    public function addReservation($voiture_id, $user_id, $type_res) {

        $sql = "SELECT ajout_reservation(:voiture_id, :user_id, :type_res)";

        try {
            $stmt = $this->cnx->prepare($sql);
            $stmt->bindParam(':voiture_id', $voiture_id, PDO::PARAM_INT);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->bindParam(':type_res', $type_res);

            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                return $row['ajout_reservation'] ?? true;
            }
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}
?>