<header class="bg-gris-clair shadow-sm sticky-top">
    <nav class="navbar navbar-expand-lg navbar-light container py-3">
        <a class="navbar-brand font-impact fs-3 m-0" href="<?= $isAdmin ? '../index_.php' : 'index_.php' ?>">AUTO GARAGE KEREM 42</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav ms-auto align-items-center gap-3">
                <li class="nav-item">
                    <a href="<?= $isAdmin ? '../index_.php' : 'index_.php' ?>" class="nav-link fw-bold text-dark hover-orange">Accueil</a>
                </li>
                <li class="nav-item">
                    <a href="<?= $isAdmin ? '../index_.php?page=contact' : 'index_.php?page=contact' ?>" class="nav-link fw-bold text-dark hover-orange">Contact</a>
                </li>

                <?php if (isset($_SESSION['user_id'])): ?>

                    <?php if ($_SESSION['role'] === 'admin'): ?>
                        <li class="nav-item">
                            <?php $lien_admin = $isAdmin ? 'index_.php' : 'admin/index_.php'; ?>
                            <a href="<?= $lien_admin ?>" class="btn btn-sm btn-danger fw-bold rounded-pill px-3">Panel Admin</a>
                        </li>
                    <?php endif; ?>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle fw-bold text-dark" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                            Bonjour, <?= htmlspecialchars($_SESSION['nom']) ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item fw-bold" href="<?= $isAdmin ? '../index_.php?page=reservation' : 'index_.php?page=reservation' ?>">Mes réservations</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger fw-bold" href="<?= $isAdmin ? '../index_.php?page=deconnexion' : 'index_.php?page=deconnexion' ?>">Déconnexion</a></li>
                        </ul>
                    </li>

                <?php else: ?>
                    <li class="nav-item">
                        <a href="index_.php?page=connexion" class="btn btn-orange fw-bold rounded-pill px-4">Se connecter</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
</header>