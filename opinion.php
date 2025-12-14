<?php
// Incluir configuración
require_once __DIR__ . '/config/database.php';
?>
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Opinión - Bolivar por siempre</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/opinion.css">
</head>
<body>
    <?php include 'navbar.php'; ?>

    <main class="page-container">
        <div class="page-header">
            <img src="assets/img/LaOpinion.jpeg" alt="Opinión">
            <h1>Opinión</h1>
        </div>

        <div class="page-content" style="text-align: justify;" >
            <article class="opinion-article">
                <h2>Victoria Contando los Minutos</h2>

                <div style="text-align: right; font-size: 14px; color: #555; margin-bottom: 30px;">
                  Por: <strong>Javier Ortuño</strong> | 9 de diciembre de 2025
                </div>

                <p>
                    Fueron diez minutos largos. Independiente buscaba el empate mientras nuestro equipo parecía estar con las piernas gastadas. El final se hizo esperar, pero celebramos otro triunfo de visitante, esta vez en la Capital.
                </p>
                <p>
                    En el momento clave, cuando debíamos asegurar la victoria con un hombre más en cancha, llegó la expulsión de Echeverría —no por culpa suya, sino por errores de Torrén y Freitas— y nuevamente apareció ese afán desconcertante de jugar hacia atrás.
                </p>
                <p>
                    Otra vez vimos salidas inexplicables como las de Romero, mientras Cauteruccio quedaba como adorno adelante y no marcaba. El ingreso tardío de Ervin Vaca —uno de los mejores en los últimos cinco cotejos—, un Cataño desmotivado… detalles que sumaron nervios al cierre.
                </p>
                <p>
                    Aun así, llegó la victoria. Empujamos todos para que el reloj avanzara y para que Independiente tropezara en casa. Los puntos hoy valen oro: dos horas más tarde Tigre perdió ante Always y aseguramos el segundo puesto. El título, sin embargo, sigue lejos, porque Guabirá vendrá con equipo suplente ante la banda roja.
                </p>
                <p>
                    El partido empezó con un gol al minuto, oportuno Cauteruccio que hizo el tanto y nada más. En ese primer cuarto de hora pudimos marcar dos más, pero poco a poco nos enfriamos mientras el rival crecía alentado por su tribuna.
                </p>
                <p>
                    Llegó el empate de Independiente, las llegadas constantes, la lentitud exasperante de Lampe, Torrén y Echeverría, los errores de José Sagredo, el nerviosismo de Freitas y el cansancio de Justiniano. La pregunta surgía una y otra vez: ¿por qué no juega Ervin Vaca?
                </p>
                <p>
                    El gol del triunfo fue mérito total de Dorny Romero: el que pierde goles cantados pero concreta los más difíciles. Con 1,73 de estatura, les gana en el salto a rivales de 1,80. Así llegó su gol, superando primero a su marcador y luego al portero.
                </p>
                <p>
                    Se ganó sufriendo. Los que ingresaron desde la banca no aportaron mucho, pero lo importante son los tres puntos, que hoy nos colocan segundos.
                </p>
                 <p>
                    Desde Bolívar por Siempre seguimos apostando por más victorias. Estamos en racha, aunque a veces haya que sufrir.
                </p>
            </article>

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

    <script src="assets/js/share.js"></script>
</body>
</html>
