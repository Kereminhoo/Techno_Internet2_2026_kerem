<main class="container py-5 flex-grow-1 bg-sombre">
    <div class="row justify-content-center">
        <div class="col-md-8 bg-light p-4 cadre-arrondi shadow">
            <h2 class="text-center mb-4 font-impact text-dark">NOUS CONTACTER</h2>

            <form id="form-contact">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Nom</label>
                        <input type="text" name="nom" class="form-control rounded-pill"
                               value="<?= $_SESSION['nom'] ?? '' ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Email</label>
                        <input type="email" name="email" class="form-control rounded-pill"
                               value="<?= $_SESSION['email'] ?? '' ?>" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Sujet</label>
                    <input type="text" name="sujet" class="form-control rounded-pill" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Message</label>
                    <textarea name="message" class="form-control" rows="5" style="border-radius: 15px;" required></textarea>
                </div>

                <div id="contact-feedback" class="mb-3 d-none"></div>

                <div class="text-center">
                    <button type="submit" class="btn btn-orange-large fw-bold px-5">ENVOYER LE MESSAGE</button>
                </div>
            </form>
        </div>
    </div>
</main>