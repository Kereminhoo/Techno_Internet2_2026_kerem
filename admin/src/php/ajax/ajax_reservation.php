<?php

header('Content-Type: application/json');
require '../utils/all_includes.php';


$voiture_id = $_POST['voiture_id'] ?? null;
$user_id = 1;
$type_res = '48h';

if ($voiture_id) {

    $reservationDAO = new ReservationDAO($cnx);
    $id_res = $reservationDAO->addReservation($voiture_id, $user_id, $type_res);

    if ($id_res) {
        echo json_encode(['success' => true, 'message' => 'Réservation validée !']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erreur lors de la réservation.']);
    }
    header('Content-Type: application/json');
    require '../utils/all_includes.php';

    $voiture_id = $_POST['voiture_id'] ?? null;

    $user_id = $_SESSION['user_id'] ?? null;
    $type_res = '48h';


    if ($voiture_id && $user_id) {

        $reservationDAO = new ReservationDAO($cnx);
        $id_res = $reservationDAO->addReservation($voiture_id, $user_id, $type_res);

        if ($id_res) {
            echo json_encode(['success' => true, 'message' => 'Réservation validée !']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Erreur lors de la réservation.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Veuillez vous connecter pour réserver.']);
    }

} else {
    echo json_encode(['success' => false, 'message' => 'ID manquant.']);
}
?>