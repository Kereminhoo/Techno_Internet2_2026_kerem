<?php
session_start();


$isAdmin = (strpos($_SERVER['SCRIPT_NAME'], 'admin') !== false);

if ($isAdmin) {

    $pathDb = 'src/php/db/db_pg_connect.php';
    $pathAutoloader = 'src/php/classes/Autoloader.class.php';


    if (!file_exists($pathDb)) {

        $pathDb = '../db/db_pg_connect.php';
        $pathAutoloader = '../classes/Autoloader.class.php';
    }
} else {

    $pathDb = 'admin/src/php/db/db_pg_connect.php';
    $pathAutoloader = 'admin/src/php/classes/Autoloader.class.php';
}


if (file_exists($pathDb) && file_exists($pathAutoloader)) {
    require_once $pathDb;
    require_once $pathAutoloader;


    Autoloader::register();


    $cnx = Connexion::getInstance($dsn, $user, $pass);
} else {

    die("Erreur fatale : Impossible de charger les fichiers de configuration.");
}
?>