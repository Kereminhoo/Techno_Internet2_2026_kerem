<?php
class Connexion {

    private static $pdo = null;

    public static function getInstance($dsn, $user, $pass) {

        if (self::$pdo === null) {
            try {
                self::$pdo = new PDO($dsn, $user, $pass);

                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                print "Erreur de connexion : " . $e->getMessage() . "<br/>";
                die();
            }
        }
        return self::$pdo;
    }
}
?>