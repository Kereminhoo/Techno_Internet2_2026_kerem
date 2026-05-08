<?php



require 'src/php/utils/all_includes.php';


if (!isset($_SESSION['user_id'])) {

    header("Location: ../index_.php?page=connexion");
    exit;
}

$message_info = "";


if (isset($_POST['btn_ajouter'])) {

    $marque = $_POST['marque'];
    $modele = $_POST['modele'];
    $annee = $_POST['annee'];
    $prix = $_POST['prix'];
    $km = $_POST['km'];
    $description = $_POST['description'];
    $image = $_POST['image'];

    $status = ($_POST['status'] == '1') ? true : false;
    $cat_id = $_POST['cat_id'];


    $voitureDAO = new VoitureDAO($cnx);
    $nouvel_id = $voitureDAO->addVoiture($marque, $modele, $annee, $prix, $km, $description, $image, $status, $cat_id);


    if ($nouvel_id) {
        $message_info = "<div class='alert alert-success fw-bold text-center'>Véhicule ajouté avec succès ! (ID : $nouvel_id)</div>";
    } else {
        $message_info = "<div class='alert alert-danger fw-bold text-center'>Erreur lors de l'ajout du véhicule.</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Administration - Garage Kerem 42</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark d-flex flex-column min-vh-100">

<?php

require 'src/php/utils/header.php';
require 'src/php/utils/admin_menu.php';
?>

<main class="container py-4 my-4 shadow" style="background-color: #d3d3d3; border-radius: 10px; max-width: 800px;">
    <h2 class="text-center mb-4 fw-bold" style="font-family: Impact, sans-serif;">AJOUTER UN VÉHICULE</h2>

    <?= $message_info ?>

    <form method="POST" action="">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Marque</label>
                <input type="text" name="marque" class="form-control" required placeholder="ex: Renault">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Modèle</label>
                <input type="text" name="modele" class="form-control" required placeholder="ex: Clio">
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label fw-bold">Année</label>
                <input type="number" name="annee" class="form-control" required placeholder="2020">
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label fw-bold">Prix (€)</label>
                <input type="number" step="0.01" name="prix" class="form-control" required placeholder="15000">
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label fw-bold">Kilométrage</label>
                <input type="number" name="km" class="form-control" required placeholder="45000">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Description</label>
            <textarea name="description" class="form-control" rows="3" required></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Lien de l'image</label>
            <input type="text" name="image" class="form-control" required value="https://via.placeholder.com/300x150/444444/FFFFFF?text=Nouvelle+Voiture">
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Statut</label>
                <select name="status" class="form-select">
                    <option value="1">Disponible</option>
                    <option value="0">Réservée</option>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Catégorie</label>
                <select name="cat_id" class="form-select">
                    <option value="1">Berline</option>
                    <option value="2">Break Sportif</option>
                    <option value="3">SUV</option>
                </select>
            </div>
        </div>

        <div class="text-center mt-4">
            <button type="submit" name="btn_ajouter" class="btn btn-lg text-white fw-bold px-5" style="background-color: #ff4500; border-radius: 25px;">VALIDER L'AJOUT</button>
        </div>
    </form>
</main>

<?php require 'src/php/utils/footer.php'; ?>

</body>
</html>