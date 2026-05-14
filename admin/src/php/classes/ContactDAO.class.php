<?php
class ContactDAO {
    private $cnx;

    public function __construct($cnx) {
        $this->cnx = $cnx;
    }

    public function insertMessage($nom, $email, $sujet, $message, $user_id = null) {
        $sql = "SELECT ajout_contact(:nom, :email, :sujet, :message, :user_id)";
        try {
            $stmt = $this->cnx->prepare($sql);
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':sujet', $sujet);
            $stmt->bindParam(':message', $message);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
    public function getAllMessages() {
        $sql = "SELECT * FROM liste_messages()";
        try {
            $stmt = $this->cnx->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }
}