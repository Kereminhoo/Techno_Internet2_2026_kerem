<header class="py-3" style="background-color: #d3d3d3;"> <div class="container d-flex justify-content-between align-items-center">
        <div>
            <a href="#" class="btn text-white fw-bold" style="background-color: #ff4500; border-radius: 25px; padding: 8px 30px;">contact</a>
        </div>

        <div class="text-center">
            <h1 class="m-0 fw-bold fs-3" style="font-family: Impact, sans-serif;">AUTO GARAGE KEREM 42</h1>
        </div>

        <div class="d-flex align-items-center gap-3">
            <?php if (isset($_SESSION['user_id'])): ?>
                <span class="text-dark fw-bold">Bonjour, <?= htmlspecialchars($_SESSION['nom']) ?></span>
                <a href="index_.php?page=deconnexion" class="btn btn-sm btn-outline-dark" style="border-radius: 15px;">Déconnexion</a>
            <?php else: ?>
                <span class="fs-2" style="cursor:pointer;">Panier</span>
                <a href="index_.php?page=connexion" class="text-dark text-decoration-none fs-2">Profil</a>
            <?php endif; ?>
        </div>
    </div>
</header>