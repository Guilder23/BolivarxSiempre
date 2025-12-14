<?php
// Incluir configuración
require_once __DIR__ . '/config/database.php';

// Procesar envío de comentario
$mensaje = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nombre']) && isset($_POST['comentario'])) {
    $nombre = escapar($_POST['nombre'] ?? '');
    $comentario = escapar($_POST['comentario'] ?? '');
    
    if (!empty($nombre) && !empty($comentario)) {
        if ($conn) {
            $consulta = "INSERT INTO comentarios (nombre, comentario) VALUES ('$nombre', '$comentario')";
            if ($conn->query($consulta)) {
                // Guardar mensaje en sesión
                $_SESSION['mensaje_comentario'] = 'Comentario publicado exitosamente';
                $_SESSION['tipo_mensaje'] = 'success';
                // Redirigir para evitar duplicados al recargar
                header("Location: opinion.php");
                exit();
            } else {
                $_SESSION['mensaje_comentario'] = 'Error al publicar el comentario';
                $_SESSION['tipo_mensaje'] = 'error';
            }
        }
    } else {
        $_SESSION['mensaje_comentario'] = 'Por favor completa todos los campos';
        $_SESSION['tipo_mensaje'] = 'error';
    }
}

// Recuperar mensaje de sesión si existe
if (isset($_SESSION['mensaje_comentario'])) {
    $mensaje = $_SESSION['mensaje_comentario'];
    $tipo_mensaje = $_SESSION['tipo_mensaje'];
    // Eliminar el mensaje de la sesión después de mostrarlo una vez
    unset($_SESSION['mensaje_comentario']);
    unset($_SESSION['tipo_mensaje']);
}

// Obtener comentarios
$comentarios = [];
if ($conn) {
    $resultado = $conn->query("SELECT nombre, comentario, fecha_creacion FROM comentarios ORDER BY fecha_creacion DESC");
    if ($resultado) {
        while ($fila = $resultado->fetch_assoc()) {
            $comentarios[] = $fila;
        }
    }
}
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

            <!-- SECCIÓN DE COMENTARIOS -->
            <section class="comentarios-section">
                <h2>Opiniones de Nuestros Seguidores</h2>
                
                <!-- COMENTARIOS PUBLICADOS -->
                <div class="comentarios-lista">
                    <h3>Comentarios (<?php echo count($comentarios); ?>)</h3>
                    
                    <?php if (!empty($comentarios)): ?>
                        <?php foreach ($comentarios as $com): ?>
                            <div class="comentario-item">
                                <div class="comentario-header">
                                    <strong><?php echo htmlspecialchars($com['nombre']); ?></strong>
                                    <span class="comentario-fecha"><?php echo date('d/m/Y H:i', strtotime($com['fecha_creacion'])); ?></span>
                                </div>
                                <p class="comentario-texto"><?php echo nl2br(htmlspecialchars($com['comentario'])); ?></p>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p style="color: #999; text-align: center; padding: 2rem;">No hay comentarios aún. ¡Sé el primero en comentar!</p>
                    <?php endif; ?>
                </div>

                <hr style="margin: 2.5rem 0; border: none; border-top: 1px solid #e2e8f0;">

                <!-- FORMULARIO -->
                <h2 style="margin-top: 2.5rem;">Deja tu Opinión</h2>
                
                <?php if (!empty($mensaje)): ?>
                    <div class="mensaje-alerta" id="mensajeAlerta" style="background: <?php echo ($tipo_mensaje === 'success') ? '#d4edda' : '#f8d7da'; ?>; color: <?php echo ($tipo_mensaje === 'success') ? '#155724' : '#721c24'; ?>; padding: 1rem; border-radius: 8px; margin-bottom: 1rem;">
                        <?php echo htmlspecialchars($mensaje); ?>
                    </div>
                    <script>
                        // Ocultar el mensaje después de 3 segundos
                        setTimeout(function() {
                            var alerta = document.getElementById('mensajeAlerta');
                            if (alerta) {
                                alerta.style.transition = 'opacity 0.5s ease';
                                alerta.style.opacity = '0';
                                setTimeout(function() {
                                    alerta.style.display = 'none';
                                }, 500);
                            }
                        }, 3000);
                    </script>
                <?php endif; ?>

                <form method="POST" class="comentario-form">
                    <div class="form-group">
                        <label for="nombre">Tu Nombre:</label>
                        <input type="text" id="nombre" name="nombre" placeholder="Ingresa tu nombre" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="comentario">Tu Comentario:</label>
                        <textarea id="comentario" name="comentario" rows="5" placeholder="Comparte tu opinión sobre el artículo..." required></textarea>
                    </div>
                    
                    <button type="submit" class="btn-enviar">Enviar Comentario</button>
                </form>
            </section>

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
        <div class="footer-bottom">
            © 2025 - Bolivar por siempre - Todos los derechos reservados
            <p style="margin-top: 10px; font-size: 1.1em; font-weight: 700; color: #a8bbd4ff; letter-spacing: 0.5px;">Desarrollado por <strong style="color: #c6d6f1ff;">Guilder Paredes Lovera</strong></p>
        </div>
    </footer>

    <script src="assets/js/index.js"></script>
</body>
</html>
