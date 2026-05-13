<?php

require 'admin/src/php/utils/all_includes.php';


$page = $_GET['page'] ?? 'accueil';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auto Garage Kerem 42</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="admin/assets/css/style.css">
</head>
<body class="bg-sombre d-flex flex-column min-vh-100">

<?php require 'admin/src/php/utils/header.php'; ?>

<?php

$chemin_page = 'content/' . $page . '.php';


if (file_exists($chemin_page)) {
    require $chemin_page;
} else {

    echo "<main class='container py-5 text-center text-white flex-grow-1'>
                <h2 class='fw-bold text-danger font-impact'>ERREUR 404</h2>
                <p>La page que vous cherchez n'existe pas dans notre garage.</p>
              </main>";
}
?>

<?php require 'admin/src/php/utils/footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="admin/assets/js/functions.js"></script>

</body>
</html>