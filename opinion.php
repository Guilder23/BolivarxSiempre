<?php
// Incluir configuración
require_once __DIR__ . '/config/database.php';

// Obtener lista de opiniones publicadas
$opiniones = [];

if ($conn) {
    $query = "SELECT * FROM opiniones WHERE estado = 'publicado' ORDER BY fecha_publicacion DESC";
    $result = mysqli_query($conn, $query);
    
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $opiniones[] = $row;
        }
    }
} else {
    // Datos de ejemplo si no hay conexión a BD
    $opiniones = [
        ['id' => 1, 'titulo' => 'Mi Opinión sobre el Club', 'contenido' => 'Esta es una opinión de ejemplo sobre el Club Bolívar...', 'imagen' => 'principal.png', 'fecha_publicacion' => date('Y-m-d H:i:s')],
    ];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Opiniones - Bolivar por siempre</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/opinion.css">
</head>
<body>
    <?php include 'navbar.php'; ?>

    <!-- Portada Opiniones -->
    <div class="page-container">
        <div class="page-header">
            <img src="assets/img/LaOpinion.jpeg" alt="Opinión" class="page-header-image">
            <h1>Opinión</h1>
        </div>

        <main class="section-content">
            <h2 style="text-align: center; color: #1e3a5f; margin: 3rem 0 2rem; font-size: 2rem;">Opiniones Recientes</h2>

            <div class="opiniones-container">
            <?php if (!empty($opiniones)): ?>
                <div class="opiniones-grid">
                    <?php foreach ($opiniones as $opinion): ?>
                        <article class="opinion-card">
                            <?php if (!empty($opinion['imagen'])): ?>
                                <img src="assets/img/opiniones/<?php echo htmlspecialchars($opinion['imagen']); ?>" alt="<?php echo htmlspecialchars($opinion['titulo']); ?>" class="opinion-image">
                            <?php else: ?>
                                <img src="assets/img/principal.png" alt="Imagen por defecto" class="opinion-image">
                            <?php endif; ?>
                            <div class="opinion-content">
                                <h2><?php echo htmlspecialchars($opinion['titulo']); ?></h2>
                                <p class="opinion-date"><?php echo date('d/m/Y H:i', strtotime($opinion['fecha_publicacion'])); ?></p>
                                <p class="opinion-text">
                                    <?php 
                                    $texto = substr($opinion['contenido'], 0, 200);
                                    echo nl2br(htmlspecialchars($texto));
                                    if (strlen($opinion['contenido']) > 200) echo '...';
                                    ?>
                                </p>
                                <a href="#" class="btn-leer-mas" data-id="<?php echo $opinion['id']; ?>">Leer más →</a>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="no-content">
                    <p>No hay opiniones publicadas en este momento.</p>
                </div>
            <?php endif; ?>
            </div>
        </main>

        <div class="volver-inicio">
            <a href="index.php" class="btn-volver">← Volver al inicio</a>
        </div>
    </div>

    <footer class="footer">
        <div class="footer-container">
            <div class="footer-section about">
                <h3>Bolivar por siempre</h3>
                <p>Institución deportiva referente del país con una historia rica en éxitos y tradición.</p>
            </div>
            <div class="footer-section links">
                <h3>Enlaces</h3>
                <ul>
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="opinion.php">Opiniones</a></li>
                    <li><a href="historia.php">Historia</a></li>
                    <li><a href="tabla.php">Tabla de Posiciones</a></li>
                </ul>
            </div>
            <div class="footer-section social">
                <h3>Síguenos</h3>
                <div class="social-links">
                    <a href="#" target="_blank">Facebook</a>
                    <a href="#" target="_blank">Twitter</a>
                    <a href="#" target="_blank">Instagram</a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 Bolivar por siempre - Todos los derechos reservados</p>
        </div>
    </footer>

    <script src="assets/js/opinion.js"></script>
</body>
</html>
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
