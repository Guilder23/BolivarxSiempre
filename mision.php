<?php
// Incluir configuración
require_once __DIR__ . '/config/database.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Misión y Visión - Bolivar por siempre</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/mision.css">
</head>
<body>
    <?php include 'navbar.php'; ?>

    <main class="page-container">
        <div class="page-header">
            <img src="assets/img/principal.png" alt="Club Bolívar">
            <h1>Misión y Visión</h1>
        </div>

        <div class="page-content">
            <section class="content-section">
                <div class="section-body" style="text-align: justify;" >
                    <div>
                         Hace poco más de un año y medio lanzábamos públicamente, un primer esbozo del propósito que nos anima a apoyar desde donde estemos a la institución deportiva más grande del país, porque nacimos cobijados por esa frazada celeste de triunfos y glorias.
                    </div>
                    <div>
                        Algunos oficiosos corrieron hasta las puertas del presidente de la entidad para tergiversar nuestras propuestas, creyendo que estábamos tras sus puestos de funcionarios; nada más falaz, porque somos profesionales que tenemos nuestra ocupación diaria.
                        A raíz de esto recibimos una respuesta poco educada, menospreciando nuestro noble afán. No respondimos porque somos enemigos de las polémicas en casa.
                    </div>
                    <div>
                        ¿Qué decíamos entonces? 
                    </div>
                    <div>
                        Bolívar debe contar con un proyecto sostenible y sustentable que debe ser fortificado gradualmente. Esta propuesta apunta a una agenda concreta y amplia. Parte de una lectura social deportiva; toma en cuenta los recursos con los que se cuenta
                        (corpóreos e incorpóreos) y utiliza como metodología un avance institucional progresivo, con base en los objetivos conseguidos en los últimos años.
                    </div>
                    <div>
                        ¿Qué decíamos entonces?
                    </div>
                    <div>
                        Bolívar no es solo una institución futbolera, sino una pasión para miles de seguidores en el país, un referente como entidad que se acerca a su Centenario, un ejemplo de integración boliviana y de paceños en particular; un orgullo para los que vivimos en este país.
                    </div>
                </div>
                <div class="section-header">
                    <h2>Nuestra Visión</h2>
                    <div class="header-line"></div>
                </div>
                <div class="section-body">
                    <p>Bolívar debe mantener la insignia de institución referente en el plano deportivo nacional e internacional, reconocida por sus lauros, talentos deportivos, dirigentes de primer nivel e institución que contribuye al proceso de desarrollo e identidad del país. Bolívar es la principal marca deportiva del país.</p>
                </div>
                 <div class="section-header">
                    <h2>Nuestra Misión</h2>
                    <div class="header-line"></div>
                </div>
                <div class="section-body" style="text-align: justify;" >
                   <div>
                       Al ser una institución deportiva dedicada al fútbol profesional y otras disciplinas deportivas, debe fortificarse cada vez más para tener el equipo más competitivo del país y que pueda competir con éxito a nivel internacional, formar integralmente a deportistas de primer nivel, lograr más lauros, y hacer partícipe a la sociedad de sus proyectos y metas.
                   </div>
                    <div>
                        Entre los objetivos se apuntaba a consolidar el patrimonio deportivo adquirido y fortificarlo, alcanzar metas definidas, capaz de mantenerse con sus propios recursos y ser espejo y modelo de organización para las demás instituciones deportivas y sociales de Bolivia.
                    </div>
                    <div>
                        Para lograr este objetivo es necesario contar con una normativa interna acorde a los nuevos lineamientos internacionales en el ámbito del fútbol, a fin de consolidar a BOLIVAR institucionalmente en todos sus estamentos.  En el orden patrimonial corpóreo, defender sus bienes otorgándole el carácter y naturaleza inafectable, inalienable e intransferible; salvo y de forma excepcional con el fin de mejorar aquel patrimonio.
                    </div>
                    
                    <div>
                        Puntualizábamos la necesidad de hacer realidad nuestro Estadio de Tembladerani, consolidar el Centro Deportivo de Ananta, crear un Centro de Formación en Los Yungas; ampliar el Plan de socios para llegar a los 10.000 cotizantes, fortificar la tarea en las divisiones inferiores y recuperar el papel protagonista en la Federación de Fútbol y la Asociación de Fútbol de La Paz.
                        Mirando siempre adelante, hoy ratificamos este compromiso, con mayor vigor que al inicio.
                    </div>
                    
                </div>
            </section>
        </div>

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
