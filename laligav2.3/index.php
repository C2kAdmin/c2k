<!-- Archivo: index.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyecto Modular</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/script.js" defer></script>
</head>
<body>
    <!-- Encabezado -->
    <header>
        <h1>Mi Proyecto Modular</h1>
    </header>

    <!-- Menú de navegación -->
    <nav>
        <ul id="menu" class="menu">
            <li><button class="menu-button" data-module="mod1">Módulo 1</button></li>
        	<li><button class="menu-button" data-module="mod2">Módulo 2</button></li>
            <li><button class="menu-button" data-module="mod3">Módulo 3</button></li>
        </ul>
        <button id="hamburger-menu" class="hamburger">☰</button>
    </nav>

    <!-- Contenido principal -->
    <div class="container">
        <!-- Columna izquierda -->
        <aside class="sidebar-left">Izquierda</aside>

        <!-- Área principal para contenido dinámico -->
        <main id="main-content">Cargando contenido...</main>

        <!-- Columna derecha -->
        <aside class="sidebar-right">Derecha</aside>
    </div>

    <!-- Pie de página -->
    <footer>
        <p>© 2024 Mi Proyecto Modular</p>
    </footer>
</body>
</html>
