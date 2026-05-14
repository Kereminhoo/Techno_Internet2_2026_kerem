<?php
$contactDAO = new ContactDAO($cnx);
$messages = $contactDAO->getAllMessages();
?>

<main class="container py-4 my-4 shadow bg-gris-clair cadre-arrondi">
    <h2 class="text-center mb-4 font-impact">MESSAGES REÇUS</h2>

    <div class="table-responsive bg-white p-3 shadow-sm cadre-arrondi">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
            <tr>
                <th>Date</th>
                <th>Expéditeur</th>
                <th>Sujet</th>
                <th>Message</th>
            </tr>
            </thead>
            <tbody>
            <?php if ($messages): foreach ($messages as $m): ?>
                <tr>
                    <td class="small text-muted">
                        <?= date('d/m/Y H:i', strtotime($m['date_envoi'])) ?>
                    </td>
                    <td>
                        <strong><?= htmlspecialchars($m['nom']) ?></strong><br>
                        <span class="small"><?= htmlspecialchars($m['email']) ?></span>
                    </td>
                    <td class="fw-bold"><?= htmlspecialchars($m['sujet']) ?></td>
                    <td>
                        <div class="p-2 bg-light border rounded small">
                            <?= nl2br(htmlspecialchars($m['message'])) ?>
                        </div>
                    </td>
                </tr>
            <?php endforeach; else: ?>
                <tr><td colspan="4" class="text-center text-muted">Aucun message pour le moment.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</main>