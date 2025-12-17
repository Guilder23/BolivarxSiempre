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
    <link rel="stylesheet" href="assets/css/destacado.css">
</head>
<body>
    <?php include 'navbar.php'; ?>

    <main class="page-container">
        <div class="page-header">
            <img src="assets/img/LaOpinion.jpeg" alt="Opinión" class="page-header-image">
            <h1>Opinión</h1>
        </div>

        <div class="page-content">
            <section class="content-section">
                <div class="section-header">
                    <h2>Opiniones Recientes</h2>
                    <div class="header-line"></div>
                </div>
                
                <?php if (!empty($opiniones)): ?>
                    <?php foreach ($opiniones as $opinion): ?>
                        <article class="featured-card">
                            <figure class="card-figure">
                                <?php 
                                if (!empty($opinion['imagen'])) {
                                    $imagen_url = 'assets/img/opiniones/' . htmlspecialchars($opinion['imagen']);
                                    echo '<img src="' . $imagen_url . '" alt="' . htmlspecialchars($opinion['titulo']) . '">';
                                } else {
                                    echo '<img src="assets/img/Portada_BolivarXSiempre.jpg" alt="Opinión">';
                                }
                                ?>
                                <?php if (!empty($opinion['pie_foto'])): ?>
                                    <figcaption class="pie-foto"><?php echo htmlspecialchars($opinion['pie_foto']); ?></figcaption>
                                <?php endif; ?>
                            </figure>
                            <div class="featured-card-content">
                                <h3><?php echo htmlspecialchars($opinion['titulo']); ?></h3>
                                <p class="author">Publicado el <?php 
                                    $fecha = strtotime($opinion['fecha_publicacion']);
                                    $meses = ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'];
                                    $mes = $meses[date('n', $fecha) - 1];
                                    echo date('d', $fecha) . ' de ' . $mes . ' de ' . date('Y', $fecha);
                                ?></p>
                                <p><?php echo nl2br(htmlspecialchars($opinion['contenido'])); ?></p>
                            </div>
                        </article>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p style="text-align: center; color: #999; padding: 2rem;">No hay opiniones publicadas en este momento.</p>
                <?php endif; ?>
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
