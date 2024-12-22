<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto</title>
    <link rel="stylesheet" href="css/styles.css?<?php echo filemtime('css/styles.css'); ?>">
    <link rel="stylesheet" href="css/animations.css"> <!-- Hoja de estilos para las animaciones -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/animations.js"></script> <!-- Archivo JavaScript para las animaciones -->
    <script src="js/script_cargamenu.js"></script> <!-- Archivo JavaScript para la carga dinámica del menú -->
</head>
<body>
    <div class="header">
        <?php include 'mods/mod_menu/mod_menu.php'; ?>
    </div>
    <div class="container_ppal">
        <div class="left-column_ppal slide-right">
            <?php include 'mods/mod_lateral/mod_lateral.php'; ?>
        </div>
        
        <div class="center-column_ppal">
            <a id="contenido_ancla"></a>
            <div id="contenido_dinamico">
                <?php include 'mods/mod1/mod1.php'; ?>
            </div>
        </div>
        
        <div class="right-column_ppal slide-left">
            <?php include 'mods/mod_lateral/mod_lateral.php'; ?>
        </div>
    </div>
    <div class="container_secund">
        <div class="left-column_secun">
            <?php include 'mods/mod1_izq/mod1_izq.php'; ?>
        </div>
        
        <div class="center-column_secun">
            <div>
                <?php include 'mods/mod2/mod2.php'; ?>
            </div>
            <div>
                <?php include 'mods/mod_youtube/mod_youtube.php'; ?>
            </div>
        </div>
        
        <div class="right-column_secun slide-up">
            <?php include 'mods/mod1_der/mod1_der.php'; ?>
        </div>
    </div>
    <div class="section_ppal1">
        <?php include 'mods/mod_googlemaps/mod_googlemaps.php'; ?>
        <?php include 'mods/mod_contacto/mod_contacto.php'; ?>
        <?php include 'mods/mod_facebook/mod_facebook.php'; ?>
    </div>
    <div class="section_ppal2">
        <?php include 'mods/mod_antefooter/mod_antefooter.php'; ?>
        <?php include 'mods/mod_antefooter_ext/mod_antefooter_ext.php'; ?>
    </div>
    <div class="section-footer">
        <?php include 'mods/mod_footer/mod_footer.php'; ?>
    </div>
    
    <script src="mods/mod_contacto/contact.js"></script>
</body>
</html>
