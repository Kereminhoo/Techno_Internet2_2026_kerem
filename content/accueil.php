<?php
?>

<main class="container-fluid py-5 bg-sombre flex-grow-1">
    <div class="container">

        <form id="form-recherche" class="row justify-content-center mb-5 gap-2">
            <div class="col-md-6">
                <input type="text" id="input-recherche" name="recherche" class="form-control rounded-pill" placeholder="recherche (ex: Renault, Clio...)">
            </div>
            <div class="col-md-3">
                <select id="select-tri" name="tri" class="form-select rounded-pill">
                    <option value="">tri (par défaut)</option>
                    <option value="prix_asc">Prix croissant</option>
                    <option value="prix_desc">Prix décroissant</option>
                </select>
            </div>
        </form>

        <div id="resultats-voitures" class="row justify-content-center gap-4">

            <div class="col-12 text-center text-white mt-5">
                <h3>Chargement des véhicules...</h3>
            </div>

        </div>
    </div>
</main>