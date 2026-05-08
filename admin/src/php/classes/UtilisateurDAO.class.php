<?php


class UtilisateurDAO {
    private $cnx;

    public function __construct($cnx) {
        $this->cnx = $cnx;
    }


    public function getUtilisateurParEmail($email) {
        $sql = "SELECT * FROM utilisateur WHERE email = :email";

        try {
            $stmt = $this->cnx->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            $data = $stmt->fetch(PDO::FETCH_ASSOC);


            if ($data) {
                return new Utilisateur(
                    $data['user_id'],
                    $data['nom'],
                    $data['email'],
                    $data['mot_de_passe'],
                    $data['role']
                );
            }
            return null;

        } catch (PDOException $e) {
            print "Erreur SQL : " . $e->getMessage();
            return null;
        }
    }
}
?>