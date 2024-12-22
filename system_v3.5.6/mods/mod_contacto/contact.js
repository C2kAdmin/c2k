$(document).ready(function() {
    $('#contactForm').on('submit', function(event) {
        event.preventDefault();

        var formData = $(this).serialize();

        $.ajax({
            type: 'POST',
            url: 'mods/mod_contacto/contact_me.php',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.status === "success") {
                    $('#success-message').show();
                    $('#error-message').hide();
                    $('#contactForm')[0].reset();
                } else {
                    $('#error-message').text(response.message).show();
                    $('#success-message').hide();
                }
            },
            error: function() {
                $('#error-message').text("Hubo un error enviando su mensaje.").show();
                $('#success-message').hide();
            }
        });
    });
});
