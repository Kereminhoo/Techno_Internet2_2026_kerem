<?php

require 'src/php/utils/all_includes.php';


if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index_.php");
    exit;
}


$voitureDAO = new VoitureDAO($cnx);
$page = $_GET['page'] ?? 'accueil';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - Garage Kerem 42</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="bg-dark d-flex flex-column min-vh-100">

<?php require 'src/php/utils/header.php'; ?>
<?php require 'src/php/utils/admin_menu.php'; ?>

<?php
if ($page === 'accueil') {

    require 'content/accueil.php';
} elseif ($page === 'modifier') {
    require 'content/modifier.php';
} else {
    echo "<h2 class='text-white text-center mt-5'>Page introuvable</h2>";
}
?>

<?php require 'src/php/utils/footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>