<?php
$recherche_actuelle = $_GET['recherche'] ?? '';
$tri_actuel = $_GET['tri'] ?? '';

$voitureDAO = new VoitureDAO($cnx);
$listeVoitures = $voitureDAO->getToutesLesVoitures($recherche_actuelle, $tri_actuel);
?>

<main class="container-fluid py-5" style="background-color: #212529; min-height: 50vh;">
    <div class="container">
        <div class="row justify-content-center gap-4">

            <?php
            if ($listeVoitures) :
                foreach ($listeVoitures as $voiture) :
                    ?>
                    <div class="col-md-3 p-3 d-flex flex-column shadow-sm" style="background-color: #d3d3d3; border-radius: 8px;">

                        <img src="<?= htmlspecialchars($voiture->image) ?>" class="w-100 mb-3" style="height: 200px; object-fit: cover; border-radius: 5px;" alt="<?= htmlspecialchars($voiture->marque) ?>">

                        <div class="d-flex justify-content-between mb-2 gap-2">
                            <div class="bg-white p-2 flex-grow-1" style="font-size: 0.85rem; line-height: 1.2; border-radius: 5px;">
                                <div>marque : <strong><?= htmlspecialchars($voiture->marque) ?></strong></div>
                                <div>model : <?= htmlspecialchars($voiture->modele) ?></div>
                                <div>annee : <?= htmlspecialchars($voiture->annee) ?></div>
                                <div class="text-primary mt-1">prix : <strong><?= number_format($voiture->prix, 0, ',', ' ') ?> €</strong></div>
                            </div>

                            <?php if ($voiture->status == true) : ?>
                                <div class="bg-success text-white p-2 d-flex align-items-center justify-content-center text-center fw-bold" style="width: 40%; font-size: 0.85rem; border-radius: 5px;">
                                    DISPONIBLE
                                </div>
                            <?php else : ?>
                                <div class="bg-secondary text-white p-2 d-flex align-items-center justify-content-center text-center fw-bold" style="width: 40%; font-size: 0.85rem; border-radius: 5px;">
                                    RÉSERVÉE
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="bg-white p-2 mb-3" style="font-size: 0.8rem; border-radius: 5px; flex-grow: 1;">
                            <p class="mb-0 text-muted" style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                                <?= htmlspecialchars($voiture->description) ?>
                            </p>
                        </div>

                        <div class="d-flex justify-content-center gap-3 mt-auto">
                            <button class="btn text-white fw-bold" style="background-color: #ff4500; border-radius: 20px; padding: 5px 20px;">acheter</button>

                            <button class="btn text-white fw-bold btn-reserver"
                                    data-id="<?= $voiture->voiture_id ?>"
                                    style="background-color: <?= $voiture->status ? '#ff4500' : '#6c757d' ?>; border-radius: 20px; padding: 5px 20px;"
                                <?= !$voiture->status ? 'disabled' : '' ?>>
                                <?= $voiture->status ? 'reserver' : 'Réservée ✔' ?>
                            </button>
                        </div>
                    </div>
                <?php
                endforeach;
            else :
                ?>
                <div class="col-12 text-center text-white">
                    <h3>Aucun véhicule disponible pour le moment.</h3>
                </div>
            <?php endif; ?>

        </div>
    </div>
</main>