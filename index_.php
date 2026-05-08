<?php

require 'admin/src/php/utils/all_includes.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Garage Kerem 42</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-dark d-flex flex-column min-vh-100">

<?php

require 'admin/src/php/utils/header.php';


require 'admin/src/php/utils/public_menu.php';


$page = $_GET['page'] ?? 'accueil';
$chemin_fichier = 'content/' . $page . '.php';

if (file_exists($chemin_fichier)) {
    require $chemin_fichier;
} else {
    echo "<h2 class='text-center my-5 text-white'>Erreur 404 : Page introuvable</h2>";
}


require 'admin/src/php/utils/footer.php';
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="admin/assets/js/functions.js"></script>
</body>
</html>