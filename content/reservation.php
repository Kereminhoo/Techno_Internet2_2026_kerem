<?php

if (!isset($_SESSION['user_id'])) {
    echo "<h3 class='text-white text-center my-5'>Veuillez vous connecter pour voir vos réservations.</h3>";
    return;
}


$resDAO = new ReservationDAO($cnx);
$mesReservations = $resDAO->getVoituresReservees($_SESSION['user_id']);
?>

<main class="container-fluid py-5" style="background-color: #212529; min-height: 70vh;">
    <div class="container">
        <h2 class="text-white text-center mb-5 fw-bold">VOS RÉSERVATIONS</h2>

        <div class="row justify-content-center gap-4">
            <?php if (!empty($mesReservations)) : ?>
                <?php foreach ($mesReservations as $voiture) : ?>
                    <div class="col-md-3 p-3 d-flex flex-column" style="background-color: #d3d3d3; border-radius: 8px;">
                        <img src="<?= htmlspecialchars($voiture->image) ?>" class="w-100 mb-3" style="height: 180px; object-fit: cover; border-radius: 5px;">

                        <div class="bg-white p-2 mb-3 flex-grow-1" style="border-radius: 5px;">
                            <h5 class="fw-bold mb-1"><?= htmlspecialchars($voiture->marque) ?> <?= htmlspecialchars($voiture->modele) ?></h5>
                            <p class="text-primary fw-bold mb-0"><?= number_format($voiture->prix, 0, ',', ' ') ?> €</p>
                        </div>

                        <div class="bg-success text-white p-2 text-center fw-bold" style="border-radius: 5px;">
                            CONFIRMÉ
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <div class="col-12 text-center text-white mt-5">
                    <p class="fs-4">Vous n'avez aucune réservation en cours.</p>
                    <a href="index_.php" class="btn btn-orange text-white fw-bold" style="background-color: #ff4500; border-radius: 20px;">Retour au catalogue</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>