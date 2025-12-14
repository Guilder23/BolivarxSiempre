<?php
// Incluir configuración
require_once __DIR__ . '/config/database.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historia - Bolivarpor siempre</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/historia.css">
</head>
<body>
    <?php include 'navbar.php'; ?>

    <main class="section-content" style="text-align: justify;">
        <h1>La Historia</h1>
        <img src="assets/img/historia.jpg" alt="Historia" class="section-image">
        
        <h2>Bolívar el primer campeón profesional (1950)</h2>
        
        <p>
         Litoral venía de ser el campeón amateur en 1947, 1948 y 1949, con un equipazo que era la base de la selección nacional y, en realidad, era el único equipo profesional, porque los dirigentes de la fabrica Soligno querían tener los mejores jugadores de Bolivia. Antonio “Guatón” Valencia, Gaffuri, Bustamante, Caparelli y Greco eran los pilares del equipo tricolor que llevaba los colores de la bandera italiana (verde, blanco y rojo) La fabrica Soligno contaba con 3.000 trabajadores, por tanto, Litoral tenía una de las barras más numerosas.<br>
        Bolívar empezó con altibajos en el torneo y Unión Maestranza parecía encaminarse al título con victorias rutilantes para satisfacción de los viacheños y habitantes de El Alto que seguían a los rojinegros. Justamente, la victoria frente a Maestranza por 2-1 fue decisiva para que el equipo celeste, de camisas con botones, pantalón azul y medias grises, sumara 20 puntos igualando a Litoral.<br>
        Para sorpresa de todos, en el partido definitorio del título, Bolívar se preparó rigurosamente y planteó un partido defensivo, pero en cada contragolpe que encabezaba Ugarte temblaba la portería de Gaffuri, que al final se llevó tres goles en la bolsa. Dos goles de Víctor Brown y uno de Mario Mena sellaron la victoria. Caparelli, la estrella de Litoral, nada pudo hacer ante la marca implacable de Huaranca.<br>
        Era el primer torneo profesional, porque el 25 de mayo de 1950, <br> la Asociación de Fútbol de La Paz, modificó sus estatutos y dividió el fútbol entre profesional y amateur. Litoral era el único equipo con todos los jugadores rentados, Bolívar le daba unos pesos a Ugarte y al cañonero Ramón Guillermo Santos; el resto jugaba por amor a la camiseta. Roberto Caparelli, considerado la atracción del campeonato, era el que recibía mejor paga.<br>
        El campeón alineó a Kramer; Huaranca y Vascones; el Kullu Baldellón, RamóGuillermo Santos y Miranda; Víctor Brown, Víctor Agustín Ugarte, Puertas, Mario Mena y Orozco.<br> Bolívar le ganó a Always Ready 2-1, a Northern 4-1, perdió con Litoral 3-1, perdió con Ferroviario por 6-0; empató con Atlético La Paz 0-0; goleó a The Strongest 4-0; empató con Unión Maestranza 2-2; goleó a Ingavi 5-2. En la rueda de las revanchas empató con Northern 2-2; empató con Always Ready 1-1; perdió con Ferroviario 2-1; empató con Litoral 3-3; le ganó a The Strongest 6-4, Se encaminó al título tras ganar a Unión Maestranza 2-1; superó a Atlético La Paz 3-2 y a Ingavi 4-3. <br>
        La tabla de posiciones quedó así: Bolívar 21 puntos; Litoral 21; Unión Maestranza 19, Atletico La Paz 17; Ferroviario 15; The Strongest 15; Always Ready 13, Ingavi 12; Northern 11.
        </p>
        <a href="index.php" class="btn-back">← Volver al inicio</a>
    </main>

    <footer class="footer">
        <div class="footer-container">
            <div class="footer-section about">
                <h3>Bolivar por siempre</h3>
                <p>Institución deportiva referente del país con una historia rica en éxitos y tradición.</p>
            </div>
            <div class="footer-section links">
                <h3>Enlaces Rápidos</h3>
                <ul>
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="tabla.php">Tabla de Posiciones</a></li>
                    <li><a href="destacado.php">Lo Destacado</a></li>
                    <li><a href="opinion.php">Opinión</a></li>
                    <li><a href="sugerencias.php">Sugerencias</a></li>
                </ul>
            </div>
            <div class="footer-section admin">
                <h3>Administración</h3>
                <ul>
                    <li><a href="admin/">Panel de Admin</a></li>
                    <li><a href="config/logout.php">Cerrar Sesión</a></li>
                </ul>
            </div>
        </div>
        <div class="social-icons">
            <a href="https://www.facebook.com/bolivarxsiempre" target="_blank" rel="noopener noreferrer" class="facebook" title="Síguenos en Facebook">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="https://www.instagram.com/bolivarxsiempre" target="_blank" rel="noopener noreferrer" class="instagram" title="Síguenos en Instagram">
                <i class="fab fa-instagram"></i>
            </a>
            <a href="https://www.tiktok.com/@bolivarxsiempre" target="_blank" rel="noopener noreferrer" class="tiktok" title="Síguenos en TikTok">
                <i class="fab fa-tiktok"></i>
            </a>
            <a href="javascript:compartirPagina();" class="share-btn" title="Compartir esta página">
                <i class="fas fa-share-alt"></i>
            </a>
        </div>
        <div class="footer-bottom">
            © 2025 - Bolivar por siempre - Todos los derechos reservados
            <p style="margin-top: 10px; font-size: 1.1em; font-weight: 700; color: #a8bbd4ff; letter-spacing: 0.5px;">Desarrollado por <strong style="color: #c6d6f1ff;">Guilder Paredes Lovera</strong></p>
        </div>
    </footer>

    <script src="assets/js/index.js"></script>
    <script src="assets/js/share.js"></script>
    
    <script>
        // Mostrar error de login si existe
        <?php 
        if (isset($_SESSION['error'])) {
            $error = $_SESSION['error'];
            unset($_SESSION['error']);
            echo "document.getElementById('mensajeLogin').className = 'mensaje-login error';";
            echo "document.getElementById('mensajeLogin').textContent = '$error';";
            echo "document.getElementById('loginModal').classList.add('show');";
        }
        ?>
    </script>
</body>
</html>
