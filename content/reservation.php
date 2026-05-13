<?php



if (!isset($_SESSION['user_id'])) {
    echo "<main class='container py-5 flex-grow-1 bg-sombre d-flex align-items-center justify-content-center'>
            <h3 class='text-white text-center fw-bold'>Veuillez vous connecter pour voir vos réservations.</h3>
          </main>";
    return;
}


$resDAO = new ReservationDAO($cnx);
$mesReservations = $resDAO->getVoituresReservees($_SESSION['user_id']);
?>

<main class="container-fluid py-5 bg-sombre flex-grow-1">
    <div class="container">
        <h2 class="text-white text-center mb-5 fw-bold font-impact">VOS RÉSERVATIONS</h2>

        <div class="row justify-content-center gap-4">
            <?php if (!empty($mesReservations)) : ?>
                <?php foreach ($mesReservations as $voiture) : ?>
                    <div class="col-md-3 p-3 d-flex flex-column shadow-sm carte-voiture">

                        <img src="<?= htmlspecialchars($voiture->image) ?>" class="w-100 mb-3 img-carte" alt="<?= htmlspecialchars($voiture->marque) ?>">

                        <div class="bg-white p-2 mb-3 flex-grow-1 rounded">
                            <h5 class="fw-bold mb-1"><?= htmlspecialchars($voiture->marque) ?> <?= htmlspecialchars($voiture->modele) ?></h5>
                            <p class="text-primary fw-bold mb-0"><?= number_format($voiture->prix, 0, ',', ' ') ?> €</p>
                        </div>

                        <div class="bg-success text-white p-2 text-center fw-bold rounded">
                            CONFIRMÉ
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <div class="col-12 text-center text-white mt-5">
                    <p class="fs-4">Vous n'avez aucune réservation en cours.</p>
                    <a href="index_.php" class="btn btn-orange fw-bold">Retour au catalogue</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>