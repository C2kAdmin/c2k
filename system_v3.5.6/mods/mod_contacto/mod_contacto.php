<!-- mod_contacto.php -->
<link rel="stylesheet" href="mods/mod_contacto/mod_contacto.css?<?php echo filemtime('mods/mod_contacto/mod_contacto.css'); ?>">

<div class="modulo-contacto">
    <div class="mod-contacto-columna-1">
        <h2>Contáctenos</h2>
        <p>Estamos aquí para ayudarle. Por favor, complete el siguiente formulario y nos pondremos en contacto con usted lo antes posible.</p>
    </div>
    <div class="mod-contacto-columna-2">
        <h2>Formulario de Contacto</h2>
        <div class="form-container">
            <form id="contactForm" novalidate>
                <div class="form-group">
                    <input type="text" class="form-control" style="width: calc(100% - 30px); padding: 10px; border: 1px solid #ccc; border-radius: 5px;" placeholder="Su nombre *" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" style="width: calc(100% - 30px); padding: 10px; border: 1px solid #ccc; border-radius: 5px;" placeholder="Su email *" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <input type="tel" class="form-control" style="width: calc(100% - 30px); padding: 10px; border: 1px solid #ccc; border-radius: 5px;" placeholder="Su teléfono *" id="phone" name="phone" required>
                </div>
                <div class="form-group">
                    <textarea class="form-control" style="width: calc(100% - 30px); padding: 10px; border: 1px solid #ccc; border-radius: 5px;" placeholder="Su mensaje *" id="message" name="message" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary" style="width: calc(100% - 30px); padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 5px;">Enviar</button>
            </form>
            <div id="success-message" style="display:none; color: green;">Mensaje enviado satisfactoriamente.</div>
            <div id="error-message" style="display:none; color: red;">Hubo un error enviando su mensaje.</div>
        </div>
    </div>
</div>
