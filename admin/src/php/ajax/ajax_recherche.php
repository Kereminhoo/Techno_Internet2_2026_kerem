<?php
require '../utils/all_includes.php';

$recherche = $_POST['recherche'] ?? '';
$tri = $_POST['tri'] ?? '';

$voitureDAO = new VoitureDAO($cnx);
$listeVoitures = $voitureDAO->getToutesLesVoitures($recherche, $tri);

if ($listeVoitures) {
    foreach ($listeVoitures as $voiture) {

        ?>
        <div class="col-md-3 p-3 d-flex flex-column shadow-sm carte-voiture">
            <img src="<?= htmlspecialchars($voiture->image) ?>" class="w-100 mb-3 img-carte" alt="<?= htmlspecialchars($voiture->marque) ?>">

            <div class="d-flex justify-content-between mb-2 gap-2">
                <div class="bg-white p-2 flex-grow-1 rounded small lh-sm">
                    <div>marque : <strong><?= htmlspecialchars($voiture->marque) ?></strong></div>
                    <div>model : <?= htmlspecialchars($voiture->modele) ?></div>
                    <div>annee : <?= htmlspecialchars($voiture->annee) ?></div>
                    <div class="text-primary mt-1">prix : <strong><?= number_format($voiture->prix, 0, ',', ' ') ?> €</strong></div>
                </div>

                <?php if ($voiture->status == true) : ?>
                    <div class="bg-success text-white p-2 d-flex align-items-center justify-content-center text-center fw-bold rounded small w-50">DISPONIBLE</div>
                <?php else : ?>
                    <div class="bg-secondary text-white p-2 d-flex align-items-center justify-content-center text-center fw-bold rounded small w-50">RÉSERVÉE</div>
                <?php endif; ?>
            </div>

            <div class="bg-white p-2 mb-3 rounded small flex-grow-1">
                <p class="mb-0 text-muted desc-3-lignes"><?= htmlspecialchars($voiture->description) ?></p>
            </div>

            <div class="d-flex justify-content-center gap-3 mt-auto">
                <a href="index_.php?page=achat&id=<?= $voiture->voiture_id ?>" class="btn btn-orange fw-bold text-decoration-none">acheter</a>
                <button class="btn fw-bold btn-reserver <?= $voiture->status ? 'btn-orange' : 'btn-secondary' ?>"
                        data-id="<?= $voiture->voiture_id ?>" <?= !$voiture->status ? 'disabled' : '' ?>>
                    <?= $voiture->status ? 'reserver' : 'Réservée' ?>
                </button>
            </div>
        </div>
        <?php
    }
} else {
    echo '<div class="col-12 text-center text-white"><h3>Aucun véhicule ne correspond à votre recherche.</h3></div>';
}
?>