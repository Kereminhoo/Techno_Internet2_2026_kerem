<?php



if (!isset($_SESSION['user_id'])) {
    echo "<main class='container py-5 flex-grow-1 bg-sombre d-flex align-items-center justify-content-center'>
            <div class='text-center p-4 bg-light rounded shadow' style='max-width: 500px;'>
                <h3 class='fw-bold text-danger mb-3'>Connexion requise</h3>
                <p>Veuillez vous connecter pour procéder à l'achat d'un véhicule et verser votre acompte de garantie.</p>
                <a href='index_.php?page=connexion' class='btn btn-orange fw-bold rounded-pill mt-2'>Se connecter</a>
            </div>
          </main>";
    return;
}

$voiture_id = $_GET['id'] ?? null;
$voitureDAO = new VoitureDAO($cnx);
$voiture = $voiture_id ? $voitureDAO->getVoitureById($voiture_id) : null;


if (!$voiture || !$voiture->status) {
    echo "<script>window.location.href='index_.php';</script>";
    exit;
}

$message_success = "";
$message_error = "";


if (isset($_POST['btn_confirmer_achat'])) {
    $resDAO = new ReservationDAO($cnx);


    $success = $resDAO->addReservation($voiture->voiture_id, $_SESSION['user_id'], 'Acompte (500€)');

    if ($success) {
        $message_success = "Félicitations ! Votre demande d'achat a été enregistrée avec succès. L'acompte de 500 € a été validé (simulation). Le véhicule vous est exclusivement réservé.";

        $voiture = $voitureDAO->getVoitureById($voiture_id);
    } else {
        $message_error = "Une erreur technique est survenue lors de la validation de votre achat.";
    }
}
?>

<main class="container py-5 flex-grow-1 bg-sombre">
    <div class="row justify-content-center">
        <div class="col-md-8 bg-light p-4 cadre-arrondi shadow">
            <h2 class="text-center mb-4 font-impact text-dark">FINALISER VOTRE ACHAT</h2>

            <?php if (!empty($message_success)): ?>
                <div class="alert alert-success fw-bold text-center p-4">
                    <?= $message_success ?>
                    <div class="mt-3">
                        <a href="index_.php?page=reservation" class="btn btn-sm btn-outline-success fw-bold">Voir mes réservations</a>
                    </div>
                </div>
            <?php else: ?>

                <?php if (!empty($message_error)): ?>
                    <div class="alert alert-danger fw-bold text-center"><?= $message_error ?></div>
                <?php endif; ?>

                <div class="row align-items-center mb-4 border-bottom pb-4">
                    <div class="col-md-4">
                        <img src="<?= htmlspecialchars($voiture->image) ?>" class="img-fluid rounded shadow-sm" alt="img">
                    </div>
                    <div class="col-md-8">
                        <h4 class="fw-bold text-dark"><?= htmlspecialchars($voiture->marque) ?> <?= htmlspecialchars($voiture->modele) ?></h4>
                        <p class="text-muted mb-1">Année : <?= htmlspecialchars($voiture->annee) ?> | Kilométrage : <?= number_format($voiture->km, 0, ',', ' ') ?> km</p>
                        <h5 class="text-primary fw-bold">Prix du véhicule : <?= number_format($voiture->prix, 0, ',', ' ') ?> €</h5>
                    </div>
                </div>

                <div class="p-3 bg-white border rounded mb-4">
                    <h6 class="fw-bold text-orange mb-2">Garantie par acompte réglementaire</h6>
                    <p class="small text-muted mb-0">
                        [cite_start]Conformément aux règles de notre concession, l'achat direct en ligne nécessite la validation d'un acompte de sécurité de <strong>500 €</strong> pour bloquer définitivement le véhicule. Cet acompte est intégralement restituable si une indisponibilité majeure du véhicule survient avant la vente finale.
                    </p>
                </div>

                <form method="POST" action="index_.php?page=achat&id=<?= $voiture->voiture_id ?>" class="text-center">
                    <div class="mb-4">
                        <span class="fs-4 fw-bold text-success">Montant de l'acompte à valider : 500,00 €</span>
                    </div>
                    <a href="index_.php" class="btn btn-secondary rounded-pill px-4 me-2">Annuler</a>
                    <button type="submit" name="btn_confirmer_achat" class="btn btn-orange-large fw-bold px-5">CONFIRMER ET PAYER L'ACOMPTE</button>
                </form>

            <?php endif; ?>
        </div>
    </div>
</main>