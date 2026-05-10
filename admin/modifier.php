<?php

require 'src/php/utils/all_includes.php';


if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {

    header("Location: ../index_.php");
    exit;
}

$voitureDAO = new VoitureDAO($cnx);
$id = $_GET['id'] ?? null;
$message_info = "";


$voiture = $id ? $voitureDAO->getVoitureById($id) : null;


if (!$voiture) {
    header("Location: index_.php");
    exit;
}


if (isset($_POST['btn_modifier'])) {
    $status = ($_POST['status'] == '1') ? true : false;
    $success = $voitureDAO->updateVoiture($id, $_POST['marque'], $_POST['modele'], $_POST['annee'], $_POST['prix'], $_POST['km'], $_POST['description'], $_POST['image'], $status, $_POST['cat_id']);

    if ($success) {

        header("Location: index_.php");
        exit;
    } else {
        $message_info = "<div class='alert alert-danger'>Erreur lors de la modification.</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier - Garage Kerem 42</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark d-flex flex-column min-vh-100">

<?php require 'src/php/utils/header.php'; require 'src/php/utils/admin_menu.php'; ?>

<main class="container py-4 my-4 shadow bg-light" style="border-radius: 10px; max-width: 800px;">
    <h2 class="text-center mb-4">MODIFIER LE VÉHICULE #<?= $voiture->voiture_id ?></h2>
    <?= $message_info ?>

    <form method="POST" action="">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Marque</label>
                <input type="text" name="marque" class="form-control" required value="<?= htmlspecialchars($voiture->marque) ?>">
            </div>
            <div class="col-md-6 mb-3">
                <label>Modèle</label>
                <input type="text" name="modele" class="form-control" required value="<?= htmlspecialchars($voiture->modele) ?>">
            </div>
            <div class="col-md-4 mb-3">
                <label>Année</label>
                <input type="number" name="annee" class="form-control" required value="<?= htmlspecialchars($voiture->annee) ?>">
            </div>
            <div class="col-md-4 mb-3">
                <label>Prix</label>
                <input type="number" step="0.01" name="prix" class="form-control" required value="<?= htmlspecialchars($voiture->prix) ?>">
            </div>
            <div class="col-md-4 mb-3">
                <label>Kilométrage</label>
                <input type="number" name="km" class="form-control" required value="<?= htmlspecialchars($voiture->km) ?>">
            </div>
            <div class="col-12 mb-3">
                <label>Description</label>
                <textarea name="description" class="form-control" rows="3" required><?= htmlspecialchars($voiture->description) ?></textarea>
            </div>
            <div class="col-12 mb-3">
                <label>Lien de l'image</label>
                <input type="text" name="image" class="form-control" required value="<?= htmlspecialchars($voiture->image) ?>">
            </div>
            <div class="col-md-6 mb-3">
                <label>Statut</label>
                <select name="status" class="form-select">
                    <option value="1" <?= $voiture->status ? 'selected' : '' ?>>Disponible</option>
                    <option value="0" <?= !$voiture->status ? 'selected' : '' ?>>Réservée</option>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label>Catégorie</label>
                <select name="cat_id" class="form-select">
                    <option value="1" <?= ($voiture->cat_id == 1) ? 'selected' : '' ?>>Berline</option>
                    <option value="2" <?= ($voiture->cat_id == 2) ? 'selected' : '' ?>>Break Sportif</option>
                    <option value="3" <?= ($voiture->cat_id == 3) ? 'selected' : '' ?>>SUV</option>
                </select>
            </div>
        </div>
        <div class="d-flex justify-content-between mt-4">
            <a href="index_.php" class="btn btn-secondary">Annuler</a>
            <button type="submit" name="btn_modifier" class="btn btn-success fw-bold px-5">SAUVEGARDER</button>
        </div>
    </form>
</main>
</body>
</html>