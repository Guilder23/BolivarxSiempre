<?php
// Incluir configuración
require_once __DIR__ . '/config/database.php';

// Obtener lista de historias publicadas
$historias = [];

if ($conn) {
    $query = "SELECT h.*, u.nombre as autor_nombre 
              FROM historia h
              LEFT JOIN usuarios u ON h.autor_id = u.id
              WHERE h.estado = 'publicado' 
              ORDER BY h.fecha_publicacion DESC";
    $result = mysqli_query($conn, $query);
    
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $historias[] = $row;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historia - Bolívar por siempre</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/historia.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <?php include 'navbar.php'; ?>

    <!-- Portada Historia -->
    <div class="page-container">
        <div class="page-header">
            <img src="assets/img/historia.jpg" alt="Historia" class="page-header-image">
            <h1>Historia</h1>
        </div>

        <main class="section-content">
            <h2 style="text-align: center; color: #1e3a5f; margin: 3rem 0 2rem; font-size: 2rem;">Historias Recientes</h2>
            <div class="historias-container">
                <?php if (!empty($historias)): ?>
                    <div class="historias-grid">
                        <?php foreach ($historias as $historia): ?>
                            <article class="historia-card">
                                <?php if (!empty($historia['imagen'])): ?>
                                    <img src="assets/img/historia/<?php echo htmlspecialchars($historia['imagen']); ?>" alt="<?php echo htmlspecialchars($historia['titulo']); ?>" class="historia-image">
                                <?php else: ?>
                                    <img src="assets/img/principal.png" alt="Imagen por defecto" class="historia-image">
                                <?php endif; ?>
                                <div class="historia-content">
                                    <h2><?php echo htmlspecialchars($historia['titulo']); ?></h2>
                                    <p class="historia-date"><?php echo date('d/m/Y H:i', strtotime($historia['fecha_publicacion'])); ?></p>
                                    <p class="historia-text">
                                        <?php 
                                        $texto = substr($historia['contenido'], 0, 200);
                                        echo nl2br(htmlspecialchars($texto));
                                        if (strlen($historia['contenido']) > 200) echo '...';
                                        ?>
                                    </p>
                                    <a href="#" class="btn-leer-mas" data-id="<?php echo $historia['id']; ?>">Leer más →</a>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="no-content">
                        <p>No hay historias publicadas en este momento.</p>
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
                <h3>Enlaces Rápidos</h3>
                <ul>
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="tabla.php">Tabla de Posiciones</a></li>
                    <li><a href="destacado.php">Lo Destacado</a></li>
                    <li><a href="opinion.php">Opinión</a></li>
                    <li><a href="historia.php">Historia</a></li>
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
