
$(document).ready(function() {
    $('.btn-reserver').click(function(e) {
        e.preventDefault();

        var bouton = $(this);
        var idVoiture = bouton.data('id');


        $.ajax({
            url: 'admin/src/php/ajax/ajax_reservation.php',
            type: 'POST',
            data: { voiture_id: idVoiture },
            dataType: 'json',
            success: function(response) {
                if (response.success) {

                    bouton.text('Réservée');
                    bouton.css('background-color', '#6c757d');
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
});