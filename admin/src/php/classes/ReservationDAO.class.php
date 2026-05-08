<?php
class ReservationDAO {
    private $cnx;

    public function __construct($cnx) {
        $this->cnx = $cnx;
    }


    public function addReservation($voiture_id, $user_id, $type_res) {

        $sql = "SELECT ajout_reservation(:voiture_id, :user_id, :type_res) AS retour";

        try {
            $stmt = $this->cnx->prepare($sql);


            $stmt->bindParam(":voiture_id", $voiture_id);
            $stmt->bindParam(":user_id", $user_id);
            $stmt->bindParam(":type_res", $type_res);


            $stmt->execute();


            $retour = $stmt->fetchColumn(0);

            return $retour;

        } catch (PDOException $e) {
            print "Erreur lors de la réservation : " . $e->getMessage();
            return null;
        }
    }
}
?>