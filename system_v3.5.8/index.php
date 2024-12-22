<?php
    header("Cache-Control: no-cache, must-revalidate");
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Proyecto</title>
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/animations.css">
    <script src="js/animations.js"></script>
</head>
<body>
    <div class="header">
        <?php include 'mods/mod_menu/mod_menu.php'; ?>
    </div>
    <div class="container_ppal">
        <div class="left-column_ppal">
            <?php include 'mods/mod_lat_izq/mod_lat_izq.php'; ?>
        </div>
        
        <div class="center-column_ppal">
            <a id="contenido_ancla"></a>
            <div id="contenido_dinamico">
                <?php include 'mods/mod_1/mod_1.php'; ?>
            </div>
        </div>
        
        <div class="right-column_ppal">
            <?php include 'mods/mod_lat_der/mod_lat_der.php'; ?>
        </div>
    </div>
    <div class="container_secund">
        <div class="left-column_secun">
            <?php include 'mods/mod_izq_flot/mod_izq_flot.php'; ?>
        </div>
        
        <div class="center-column_secun">
			<?php include 'mods/mod_youtube/mod_youtube.php'; ?>
            <?php include 'mods/mod_googlemaps/mod_googlemaps.php'; ?>
        </div>
        
        <div class="right-column_secun">
            <!-- Contenido de la columna derecha secundaria -->
        </div>
    </div>
    <div class="section_ppal1">
        <!-- Contenido de la columna derecha secundaria -->
    </div>
    <div class="section_ppal2">
        <?php include 'mods/mod_contacto/mod_contacto.php'; ?>
    </div>
    <div class="section-footer">
        <!-- Pie de página -->
    </div>
</body>
</html>
