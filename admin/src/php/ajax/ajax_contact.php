<?php
header('Content-Type: application/json');
require '../utils/all_includes.php';

$nom = $_POST['nom'] ?? null;
$email = $_POST['email'] ?? null;
$sujet = $_POST['sujet'] ?? null;
$message = $_POST['message'] ?? null;
$user_id = $_SESSION['user_id'] ?? null;

if ($nom && $email && $message) {
    $contactDAO = new ContactDAO($cnx);
    $success = $contactDAO->insertMessage($nom, $email, $sujet, $message, $user_id);

    if ($success) {
        echo json_encode(['success' => true, 'message' => 'Merci ! Votre message a été envoyé avec succès.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erreur technique lors de l\'envoi.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Veuillez remplir tous les champs obligatoires.']);
}