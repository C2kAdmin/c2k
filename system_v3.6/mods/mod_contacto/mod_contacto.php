<!-- mods/mod_contacto/mod_contacto.php -->
<link rel="stylesheet" href="mods/mod_contacto/mod_contacto.css">
<script src="mods/mod_contacto/mod_contacto.js"></script>

<div class="mod_contacto">
    <div class="mod_contacto_columna_1">
        <h2>Contáctenos</h2>
        <p>Estamos aquí para ayudarle. Por favor, complete el siguiente formulario y nos pondremos en contacto con usted lo antes posible.</p>
    </div>
    <div class="mod_contacto_columna_2">
        <h2>Formulario de Contacto</h2>
        <div class="form-container contact-form">
            <form id="contactForm" novalidate>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Su nombre *" id="name" name="name" required>
                </div>
                <div class="form-group email-phone-group">
                    <input type="email" class="form-control" placeholder="Su email *" id="email" name="email" required>
                    <input type="tel" class="form-control" placeholder="Su teléfono *" id="phone" name="phone" required>
                </div>
                <div class="form-group">
                    <textarea class="form-control" placeholder="Su mensaje *" id="message" name="message" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Enviar</button>
            </form>
            <div id="success-message" style="display:none; color: green;">Mensaje enviado satisfactoriamente.</div>
            <div id="error-message" style="display:none; color: red;">Hubo un error enviando su mensaje.</div>
        </div>
    </div>
</div>
