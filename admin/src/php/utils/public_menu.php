<div class="container-fluid py-3" style="background-color: #c0c0c0;">
    <div class="container d-flex justify-content-center">

        <form method="GET" action="index_.php" class="d-flex w-75 gap-3">

            <input type="hidden" name="page" value="accueil">

            <input type="text" name="recherche" class="form-control rounded-pill text-center"
                   style="border: 2px solid #ff4500;"
                   placeholder="recherche (ex: Renault, Clio...)"
                   value="<?= isset($_GET['recherche']) ? htmlspecialchars($_GET['recherche']) : '' ?>">

            <select name="tri" class="form-select rounded-pill" style="width: auto; border: 2px solid #ff4500;" onchange="this.form.submit()">
                <option value="">tri (par défaut)</option>
                <option value="prix_asc" <?= (isset($_GET['tri']) && $_GET['tri'] == 'prix_asc') ? 'selected' : '' ?>>Prix croissant</option>
                <option value="prix_desc" <?= (isset($_GET['tri']) && $_GET['tri'] == 'prix_desc') ? 'selected' : '' ?>>Prix décroissant</option>
            </select>

            <button type="submit" class="btn text-white fw-bold rounded-pill" style="background-color: #ff4500; padding: 0 25px;">Go</button>

        </form>
    </div>
</div>