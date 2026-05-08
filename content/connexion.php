<?php


$message_erreur = "";


if (isset($_POST['btn_connexion'])) {
    $email = trim($_POST['email'] ?? '');
    $mdp = $_POST['mot_de_passe'] ?? '';

    if (!empty($email) && !empty($mdp)) {

        $userDAO = new UtilisateurDAO($cnx);
        $utilisateur = $userDAO->getUtilisateurParEmail($email);


        if ($utilisateur && $utilisateur->mot_de_passe === $mdp) {


            $_SESSION['user_id'] = $utilisateur->user_id;
            $_SESSION['nom'] = $utilisateur->nom;
            $_SESSION['role'] = $utilisateur->role;


            header("Location: index_.php");
            exit;
        } else {
            $message_erreur = "Email ou mot de passe incorrect.";
        }
    } else {
        $message_erreur = "Veuillez remplir tous les champs.";
    }
}
?>

<main class="container-fluid py-5" style="background-color: #212529; min-height: 50vh;">
    <div class="container d-flex justify-content-center">
        <div class="card p-4 shadow" style="width: 100%; max-width: 400px; background-color: #d3d3d3;">
            <h3 class="text-center mb-4 fw-bold" style="font-family: Impact, sans-serif;">CONNEXION</h3>

            <?php if (!empty($message_erreur)): ?>
                <div class="alert alert-danger text-center p-2"><?= $message_erreur ?></div>
            <?php endif; ?>

            <form method="POST" action="">
                <div class="mb-3">
                    <label class="form-label fw-bold">Adresse Email</label>
                    <input type="email" name="email" class="form-control" placeholder="client@test.com" required>
                </div>
                <div class="mb-4">
                    <label class="form-label fw-bold">Mot de passe</label>
                    <input type="password" name="mot_de_passe" class="form-control" placeholder="motdepasse123" required>
                </div>
                <button type="submit" name="btn_connexion" class="btn text-white fw-bold w-100" style="background-color: #ff4500; border-radius: 20px;">SE CONNECTER</button>
            </form>
        </div>
    </div>
</main>