<?php
require 'src/php/utils/all_includes.php';


if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {

    header("Location: ../index_.php");
    exit;
}

$message_info = "";
$voitureDAO = new VoitureDAO($cnx);


if (isset($_POST['btn_ajouter'])) {
    $status = ($_POST['status'] == '1') ? true : false;
    $nouvel_id = $voitureDAO->addVoiture($_POST['marque'], $_POST['modele'], $_POST['annee'], $_POST['prix'], $_POST['km'], $_POST['description'], $_POST['image'], $status, $_POST['cat_id']);
    if ($nouvel_id) {
        $message_info = "<div class='alert alert-success fw-bold text-center'>Véhicule ajouté (ID: $nouvel_id) !</div>";
    }
}


if (isset($_POST['btn_supprimer'])) {
    if ($voitureDAO->deleteVoiture($_POST['id_supprimer'])) {
        $message_info = "<div class='alert alert-warning fw-bold text-center'>Véhicule supprimé avec succès !</div>";
    }
}


$listeVoitures = $voitureDAO->getToutesLesVoitures();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Administration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark d-flex flex-column min-vh-100">

<?php require 'src/php/utils/header.php'; require 'src/php/utils/admin_menu.php'; ?>

<main class="container py-4 my-4 shadow" style="background-color: #d3d3d3; border-radius: 10px;">
    <?= $message_info ?>

    <details class="mb-5 bg-white p-3 shadow-sm" style="border-radius: 8px;">
        <summary class="fw-bold fs-5 text-primary" style="cursor: pointer;">Cliquer ici pour AJOUTER une voiture</summary>
        <div class="mt-3">
            <form method="POST" action="">
                <div class="row">
                    <div class="col-md-6 mb-3"><input type="text" name="marque" class="form-control" required placeholder="Marque"></div>
                    <div class="col-md-6 mb-3"><input type="text" name="modele" class="form-control" required placeholder="Modèle"></div>
                    <div class="col-md-4 mb-3"><input type="number" name="annee" class="form-control" required placeholder="Année"></div>
                    <div class="col-md-4 mb-3"><input type="number" step="0.01" name="prix" class="form-control" required placeholder="Prix (€)"></div>
                    <div class="col-md-4 mb-3"><input type="number" name="km" class="form-control" required placeholder="Kilométrage"></div>
                    <div class="col-12 mb-3"><textarea name="description" class="form-control" rows="2" required placeholder="Description"></textarea></div>
                    <div class="col-12 mb-3"><input type="text" name="image" class="form-control" required value="https://via.placeholder.com/300x150/444444/FFFFFF?text=Auto"></div>
                    <div class="col-md-6 mb-3">
                        <select name="status" class="form-select"><option value="1">Disponible</option><option value="0">Réservée</option></select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <select name="cat_id" class="form-select"><option value="1">Berline</option><option value="2">Break Sportif</option><option value="3">SUV</option></select>
                    </div>
                </div>
                <button type="submit" name="btn_ajouter" class="btn btn-primary w-100 fw-bold">VALIDER L'AJOUT</button>
            </form>
        </div>
    </details>

    <h3 class="fw-bold mb-3">LISTE DES VÉHICULES</h3>
    <div class="table-responsive bg-white p-2 rounded shadow-sm">
        <table class="table table-striped align-middle">
            <thead class="table-dark">
            <tr>
                <th>ID</th><th>Image</th><th>Marque & Modèle</th><th>Prix</th><th>Statut</th><th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php if($listeVoitures): foreach($listeVoitures as $v): ?>
                <tr>
                    <td>#<?= $v->voiture_id ?></td>
                    <td><img src="<?= htmlspecialchars($v->image) ?>" height="40" alt="img"></td>
                    <td><strong><?= htmlspecialchars($v->marque) ?></strong> <?= htmlspecialchars($v->modele) ?></td>
                    <td><?= number_format($v->prix, 0, ',', ' ') ?> €</td>
                    <td><?= $v->status ? '<span class="badge bg-success">Dispo</span>' : '<span class="badge bg-secondary">Réservée</span>' ?></td>
                    <td>
                        <a href="modifier.php?id=<?= $v->voiture_id ?>" class="btn btn-sm btn-outline-primary">Modif</a>

                        <form method="POST" action="" class="d-inline" onsubmit="return confirm('Sûr de vouloir supprimer ce véhicule ?');">
                            <input type="hidden" name="id_supprimer" value="<?= $v->voiture_id ?>">
                            <button type="submit" name="btn_supprimer" class="btn btn-sm btn-danger">Suppr</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; else: ?>
                <tr><td colspan="6" class="text-center">Aucun véhicule.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</main>
<?php require 'src/php/utils/footer.php'; ?>
</body>
</html>