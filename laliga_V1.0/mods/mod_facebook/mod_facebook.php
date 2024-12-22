<!-- mod_fbook.php -->
<link rel="stylesheet" href="mods/mod_facebook/mod_facebook.css?<?php echo filemtime('mods/mod_facebook/mod_facebook.css'); ?>">

<div class="modulo-fbook">
    <div class="modulo-fbook-columna-1">
        <h2>Columna 1: Información</h2>
        <p>Este es un texto de ejemplo para la primera columna del módulo de Facebook. Aquí puedes incluir información relevante o cualquier otro contenido que desees mostrar.</p>
    </div>
    <div class="modulo-fbook-columna-2">
        <div id="fb-root"></div>
        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v20.0&appId=473906871049143" nonce="Zc14Z6qa"></script>
        <div class="fb-page" data-href="https://www.facebook.com/ConceptoCreativoC2k" data-tabs="timeline,events,messages" data-width="500" data-height="700" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
            <blockquote cite="https://www.facebook.com/ConceptoCreativoC2k" class="fb-xfbml-parse-ignore">
                <a href="https://www.facebook.com/ConceptoCreativoC2k">Concepto Creativo C2k</a>
            </blockquote>
        </div>
    </div>
    <div class="modulo-fbook-columna-3">
        <h2>Columna 3: Información Adicional</h2>
        <p>Este es otro texto de ejemplo para la tercera columna del módulo de Facebook. Aquí puedes incluir información adicional o cualquier otro contenido relevante.</p>
    </div>
</div>