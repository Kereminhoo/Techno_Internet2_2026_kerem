<?php

$voitureDAO = new VoitureDAO($cnx);
$listeVoitures = $voitureDAO->getToutesLesVoitures();
?>

<main class="container-fluid py-5" style="background-color: #212529; min-height: 50vh;">
    <div class="container">
        <div class="row justify-content-center gap-4">

            <?php

            if ($listeVoitures) :
                foreach ($listeVoitures as $voiture) :
                    ?>
                    <div class="col-md-3 p-3" style="background-color: #d3d3d3;">
                        <img src="<?= htmlspecialchars($voiture->image) ?>" class="img-fluid mb-3 w-100" alt="<?= htmlspecialchars($voiture->marque) ?>">

                        <div class="d-flex justify-content-between mb-3 gap-2">
                            <div class="bg-white p-2 flex-grow-1" style="font-size: 0.85rem; line-height: 1.2;">
                                <div>marque : <strong><?= htmlspecialchars($voiture->marque) ?></strong></div>
                                <div>model : <?= htmlspecialchars($voiture->modele) ?></div>
                                <div>annee : <?= htmlspecialchars($voiture->annee) ?></div>
                                <div class="text-primary mt-1">prix : <strong><?= number_format($voiture->prix, 0, ',', ' ') ?> €</strong></div>
                            </div>

                            <?php if ($voiture->status == true) : ?>
                                <div class="bg-success text-white p-2 d-flex align-items-center justify-content-center text-center fw-bold" style="width: 40%; font-size: 0.85rem;">
                                    DISPONIBLE
                                </div>
                            <?php else : ?>
                                <div class="bg-secondary text-white p-2 d-flex align-items-center justify-content-center text-center fw-bold" style="width: 40%; font-size: 0.85rem;">
                                    RÉSERVÉE
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="d-flex justify-content-center gap-3 mt-2">
                            <button class="btn text-white fw-bold" style="background-color: #ff4500; border-radius: 20px; padding: 5px 20px;">acheter</button>
                            <button class="btn text-white fw-bold btn-reserver" data-id="<?= $voiture->voiture_id ?>" style="background-color: #ff4500; border-radius: 20px; padding: 5px 20px;">reserver
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