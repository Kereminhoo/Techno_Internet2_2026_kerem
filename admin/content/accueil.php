<?php

$message_info = "";


if (isset($_POST['btn_ajouter'])) {

    $chemin_bdd = "admin/assets/images/default.jpg";


    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $dossier_destination = "assets/images/";
        $nom_image = time() . "_" . basename($_FILES['image']['name']);


        if (move_uploaded_file($_FILES['image']['tmp_name'], $dossier_destination . $nom_image)) {
            $chemin_bdd = "admin/assets/images/" . $nom_image;
        }
    }

    $status = ($_POST['status'] == '1') ? true : false;

    $nouvel_id = $voitureDAO->addVoiture($_POST['marque'], $_POST['modele'], $_POST['annee'], $_POST['prix'], $_POST['km'], $_POST['description'], $chemin_bdd, $status, $_POST['cat_id']);

    if ($nouvel_id) {
        $message_info = "<div class='alert alert-success fw-bold text-center'>Véhicule ajouté avec succès !</div>";
    }
}


if (isset($_POST['btn_supprimer'])) {
    if ($voitureDAO->deleteVoiture($_POST['id_supprimer'])) {
        $message_info = "<div class='alert alert-warning fw-bold text-center'>Véhicule supprimé !</div>";
    }
}


$listeVoitures = $voitureDAO->getToutesLesVoitures();
?>

<main class="container py-4 my-4 shadow" style="background-color: #d3d3d3; border-radius: 10px;">
    <?= $message_info ?>

    <details class="mb-5 bg-white p-3 shadow-sm" style="border-radius: 8px;">
        <summary class="fw-bold fs-5 text-primary" style="cursor: pointer;">+ Cliquer ici pour AJOUTER une voiture</summary>
        <div class="mt-3">
            <form method="POST" action="index_.php?page=accueil" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6 mb-3"><input type="text" name="marque" class="form-control" required placeholder="Marque"></div>
                    <div class="col-md-6 mb-3"><input type="text" name="modele" class="form-control" required placeholder="Modèle"></div>
                    <div class="col-md-4 mb-3"><input type="number" name="annee" class="form-control" required placeholder="Année"></div>
                    <div class="col-md-4 mb-3"><input type="number" step="0.01" name="prix" class="form-control" required placeholder="Prix (€)"></div>
                    <div class="col-md-4 mb-3"><input type="number" name="km" class="form-control" required placeholder="Kilométrage"></div>
                    <div class="col-12 mb-3"><textarea name="description" class="form-control" rows="2" required placeholder="Description"></textarea></div>

                    <div class="col-12 mb-3">
                        <label class="form-label fw-bold small">Photo du véhicule</label>
                        <input type="file" name="image" class="form-control" accept="image/*" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <select name="status" class="form-select">
                            <option value="1">Disponible</option>
                            <option value="0">Réservée</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <select name="cat_id" class="form-select">
                            <option value="1">Berline</option>
                            <option value="2">Break Sportif</option>
                            <option value="3">SUV</option>
                        </select>
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
                    <td>
                        <img src="../<?= htmlspecialchars($v->image) ?>" height="40" alt="img" style="object-fit: cover; width: 60px; border-radius: 4px;">
                    </td>
                    <td><strong><?= htmlspecialchars($v->marque) ?></strong> <?= htmlspecialchars($v->modele) ?></td>
                    <td><?= number_format($v->prix, 0, ',', ' ') ?> €</td>
                    <td><?= $v->status ? '<span class="badge bg-success">Dispo</span>' : '<span class="badge bg-secondary">Réservée</span>' ?></td>
                    <td>
                        <a href="index_.php?page=modifier&id=<?= $v->voiture_id ?>" class="btn btn-sm btn-outline-primary">Modif</a>

                        <form method="POST" action="index_.php?page=accueil" class="d-inline" onsubmit="return confirm('Sûr de vouloir supprimer ce véhicule ?');">
                            <input type="hidden" name="id_supprimer" value="<?= $v->voiture_id ?>">
                            <button type="submit" name="btn_supprimer" class="btn btn-sm btn-danger">Suppr</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; else: ?>
                <tr><td colspan="6" class="text-center text-muted">Aucun véhicule dans le garage.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</main>