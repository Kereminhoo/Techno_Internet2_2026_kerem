$(document).ready(function() {




    $(document).on('click', '.btn-reserver', function(e) {
        e.preventDefault();

        let bouton = $(this);
        let idVoiture = bouton.data('id');

        $.ajax({
            url: 'admin/src/php/ajax/ajax_reservation.php',
            type: 'POST',
            data: { voiture_id: idVoiture },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    bouton.text('Réservée');
                    bouton.removeClass('btn-orange').addClass('btn-secondary');
                    bouton.prop('disabled', true);
                    alert(response.message);
                } else {
                    alert(response.message);
                }
            },
            error: function() {
                alert("Erreur de communication avec le serveur.");
            }
        });
    });




    $('#form-contact').submit(function(e) {
        e.preventDefault();

        let form = $(this);
        let feedback = $('#contact-feedback');
        let submitBtn = form.find('button[type="submit"]');

        submitBtn.prop('disabled', true).text('Envoi en cours...');

        $.ajax({
            url: 'admin/src/php/ajax/ajax_contact.php',
            type: 'POST',
            data: form.serialize(),
            dataType: 'json',
            success: function(response) {
                feedback.removeClass('d-none alert-danger alert-success');
                if (response.success) {
                    feedback.addClass('alert alert-success').text(response.message);
                    form[0].reset();
                } else {
                    feedback.addClass('alert alert-danger').text(response.message);
                }
            },
            error: function() {
                feedback.removeClass('d-none alert-success').addClass('alert alert-danger').text("Erreur réseau.");
            },
            complete: function() {
                submitBtn.prop('disabled', false).text('ENVOYER LE MESSAGE');
            }
        });
    });



    function chargerVoitures() {
        let recherche = $('#input-recherche').val();
        let tri = $('#select-tri').val();

        $.ajax({
            url: 'admin/src/php/ajax/ajax_recherche.php',
            type: 'POST',
            data: { recherche: recherche, tri: tri },
            success: function(html) {
                $('#resultats-voitures').html(html);
            },
            error: function() {
                console.log("Erreur lors du chargement des voitures.");
            }
        });
    }

    $('#input-recherche').on('keyup', function() {
        chargerVoitures();
    });

    $('#select-tri').on('change', function() {
        chargerVoitures();
    });

    $('#form-recherche').submit(function(e) {
        e.preventDefault();
    });

    if ($('#resultats-voitures').length > 0) {
        chargerVoitures();
    }

});