<?php
require_once '../../config/database.php';
require_once '../../includes/auth.php';

requerir_admin();

// ===== FUNCIONES DE UTILIDAD =====
function procesar_imagen_opinion($file) {
    $carpeta_uploads = '../../assets/img/opiniones/';
    
    // Crear carpeta si no existe
    if (!is_dir($carpeta_uploads)) {
        mkdir($carpeta_uploads, 0755, true);
    }
    
    if ($file['error'] === UPLOAD_ERR_NO_FILE) {
        return null; // Sin imagen es válido
    }
    
    if ($file['error'] !== UPLOAD_ERR_OK) {
        throw new Exception('Error al subir la imagen');
    }
    
    // Validar tipo de archivo
    $tipos_permitidos = ['image/jpeg', 'image/png', 'image/gif'];
    if (!in_array($file['type'], $tipos_permitidos)) {
        throw new Exception('Tipo de archivo no permitido. Solo JPG, PNG y GIF');
    }
    
    // Validar tamaño (5MB máximo)
    if ($file['size'] > 5 * 1024 * 1024) {
        throw new Exception('El archivo es muy grande. Máximo 5MB');
    }
    
    // Generar nombre único
    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    $nombre_archivo = 'opinion_' . time() . '_' . rand(1000, 9999) . '.' . $ext;
    $ruta_completa = $carpeta_uploads . $nombre_archivo;
    
    // Mover archivo
    if (!move_uploaded_file($file['tmp_name'], $ruta_completa)) {
        throw new Exception('Error al guardar la imagen');
    }
    
    return $nombre_archivo;
}

// Procesar acciones
$accion = $_GET['accion'] ?? $_POST['accion'] ?? null;

// CREAR OPINIÓN
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $accion === 'crear') {
    $titulo = escapar($_POST['titulo'] ?? '');
    $contenido = escapar($_POST['contenido'] ?? '');
    $estado = escapar($_POST['estado'] ?? 'borrador');
    $pie_foto = escapar($_POST['pie_foto'] ?? '');
    $usuario_id = $_SESSION['usuario_id'];
    
    if (empty($titulo) || empty($contenido)) {
        $respuesta = ['exito' => false, 'mensaje' => 'Todos los campos son requeridos'];
    } else {
        try {
            // Procesar imagen
            $imagen = null;
            if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] !== UPLOAD_ERR_NO_FILE) {
                $imagen = procesar_imagen_opinion($_FILES['imagen']);
            }
            
            $imagen_valor = $imagen ? "'$imagen'" : 'NULL';
            $pie_foto_valor = !empty($pie_foto) ? "'$pie_foto'" : 'NULL';
            $fecha_publicacion = ($estado === 'publicado') ? date('Y-m-d H:i:s') : NULL;
            
            $consulta = "INSERT INTO opiniones (titulo, contenido, autor_id, imagen, pie_foto, estado, fecha_publicacion) 
                         VALUES ('$titulo', '$contenido', $usuario_id, $imagen_valor, $pie_foto_valor, '$estado', " . ($fecha_publicacion ? "'$fecha_publicacion'" : "NULL") . ")";
            
            if ($conn && $conn->query($consulta)) {
                $respuesta = ['exito' => true, 'mensaje' => 'Opinión creada exitosamente'];
            } else {
                $error_msg = $conn ? $conn->error : 'No hay conexión a la base de datos';
                $respuesta = ['exito' => false, 'mensaje' => 'Error al crear la opinión: ' . $error_msg];
            }
        } catch (Exception $e) {
            $respuesta = ['exito' => false, 'mensaje' => 'Error: ' . $e->getMessage()];
        }
    }
    
    header('Content-Type: application/json');
    echo json_encode($respuesta);
    exit();
}

// OBTENER OPINIÓN PARA EDITAR/VER
if ($accion && in_array($accion, ['editar', 'ver']) && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $resultado = $conn->query("SELECT o.*, u.nombre as autor FROM opiniones o LEFT JOIN usuarios u ON o.autor_id = u.id WHERE o.id = $id LIMIT 1");
    
    if ($resultado && $resultado->num_rows > 0) {
        $opinion = $resultado->fetch_assoc();
        
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
            // Es AJAX, devolver el formulario
            include 'Modals/' . $accion . '.php';
        }
    }
    exit();
}

// ACTUALIZAR OPINIÓN
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $accion === 'editar') {
    $id = (int)$_POST['id'];
    $titulo = escapar($_POST['titulo'] ?? '');
    $contenido = escapar($_POST['contenido'] ?? '');
    $estado = escapar($_POST['estado'] ?? 'borrador');
    $pie_foto = escapar($_POST['pie_foto'] ?? '');
    
    if (empty($titulo) || empty($contenido)) {
        $respuesta = ['exito' => false, 'mensaje' => 'Todos los campos son requeridos'];
    } else {
        try {
            // Obtener datos actuales de la opinión
            $resultado_actual = $conn->query("SELECT imagen FROM opiniones WHERE id = $id LIMIT 1");
            $opinion_actual = $resultado_actual->fetch_assoc();
            $imagen = $opinion_actual['imagen']; // Mantener imagen actual por defecto
            
            // Procesar imagen si se subió una nueva
            if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] !== UPLOAD_ERR_NO_FILE) {
                $imagen = procesar_imagen_opinion($_FILES['imagen']);
            }
            
            $fecha_publicacion = ($estado === 'publicado') ? date('Y-m-d H:i:s') : NULL;
            $imagen_valor = $imagen ? "'$imagen'" : 'NULL';
            $pie_foto_valor = !empty($pie_foto) ? "'$pie_foto'" : 'NULL';
            
            $consulta = "UPDATE opiniones SET 
                         titulo = '$titulo',
                         contenido = '$contenido',
                         imagen = $imagen_valor,
                         pie_foto = $pie_foto_valor,
                         estado = '$estado',
                         fecha_publicacion = " . ($fecha_publicacion ? "'$fecha_publicacion'" : "NULL") . ",
                         fecha_actualizacion = NOW()
                         WHERE id = $id";
            
            if ($conn && $conn->query($consulta)) {
                $respuesta = ['exito' => true, 'mensaje' => 'Opinión actualizada exitosamente'];
            } else {
                $error_msg = $conn ? $conn->error : 'No hay conexión a la base de datos';
                $respuesta = ['exito' => false, 'mensaje' => 'Error al actualizar: ' . $error_msg];
            }
        } catch (Exception $e) {
            $respuesta = ['exito' => false, 'mensaje' => 'Error: ' . $e->getMessage()];
        }
    }
    
    header('Content-Type: application/json');
    echo json_encode($respuesta);
    exit();
}

// ELIMINAR OPINIÓN
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $accion === 'eliminar') {
    $id = (int)$_POST['id'];
    
    // Obtener imagen para eliminarla
    $resultado = $conn->query("SELECT imagen FROM opiniones WHERE id = $id LIMIT 1");
    if ($resultado && $resultado->num_rows > 0) {
        $opinion = $resultado->fetch_assoc();
        if ($opinion['imagen']) {
            $archivo = '../../assets/img/opiniones/' . $opinion['imagen'];
            if (file_exists($archivo)) {
                unlink($archivo);
            }
        }
    }
    
    $consulta = "DELETE FROM opiniones WHERE id = $id";
    
    if ($conn && $conn->query($consulta)) {
        $respuesta = ['exito' => true, 'mensaje' => 'Opinión eliminada exitosamente'];
    } else {
        $error_msg = $conn ? $conn->error : 'No hay conexión a la base de datos';
        $respuesta = ['exito' => false, 'mensaje' => 'Error al eliminar: ' . $error_msg];
    }
    
    header('Content-Type: application/json');
    echo json_encode($respuesta);
    exit();
}

// OBTENER TABLA DE OPINIONES
if ($accion === 'obtener_tabla') {
    // OBTENER TODAS LAS OPINIONES
    $opiniones = [];
    $resultado = $conn->query("SELECT o.*, u.nombre FROM opiniones o JOIN usuarios u ON o.autor_id = u.id ORDER BY o.fecha_creacion DESC");

    if ($resultado) {
        while ($fila = $resultado->fetch_assoc()) {
            $opiniones[] = $fila;
        }
    }
    
    // Generar HTML de la tabla (sin encabezados)
    ?>
    <?php if (!empty($opiniones)): ?>
        <?php foreach ($opiniones as $opinion): ?>
            <tr>
                <td><?php echo htmlspecialchars(substr($opinion['titulo'], 0, 40)); ?></td>
                <td><?php echo htmlspecialchars($opinion['nombre']); ?></td>
                <td><span class="badge badge-<?php echo $opinion['estado']; ?>"><?php echo ucfirst($opinion['estado']); ?></span></td>
                <td><?php echo date('d/m/Y H:i', strtotime($opinion['fecha_creacion'])); ?></td>
                <td>
                    <div class="acciones">
                        <button class="btn-action btn-secondary" onclick="abrirModalAdmin('modalVerOpinion', 'ver', <?php echo $opinion['id']; ?>)">Ver</button>
                        <button class="btn-action btn-primary" onclick="abrirModalAdmin('modalEditarOpinion', 'editar', <?php echo $opinion['id']; ?>)">Editar</button>
                        <button class="btn-action btn-danger" onclick="abrirModalConfirmacion('eliminar_opinion', <?php echo $opinion['id']; ?>, '<?php echo htmlspecialchars($opinion['titulo']); ?>')">Eliminar</button>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="5" class="text-center">No hay opiniones registradas</td>
        </tr>
    <?php endif; ?>
    <?php
    exit();
}

// OBTENER TODAS LAS OPINIONES
$opiniones = [];
$resultado = $conn->query("SELECT o.*, u.nombre FROM opiniones o JOIN usuarios u ON o.autor_id = u.id ORDER BY o.fecha_creacion DESC");

if ($resultado) {
    while ($fila = $resultado->fetch_assoc()) {
        $opiniones[] = $fila;
    }
}

$usuario = obtener_usuario_actual();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Opiniones - Bolivar por siempre</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/admin/dashboard.css">
    <link rel="stylesheet" href="../../assets/css/admin/noticias.css">
</head>
<body>
    <div class="admin-container">
        <!-- Botón Toggle Sidebar Móvil -->
        <button class="sidebar-toggle" id="sidebarToggle" onclick="toggleSidebar()" aria-label="Abrir menú">
            <i class="fas fa-bars"></i>
        </button>
        
        <!-- Overlay para cerrar sidebar -->
        <div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>
        
        <!-- SIDEBAR -->
        <aside class="sidebar" id="adminSidebar">
            <div class="sidebar-header">
                <h3>BOLIVAR por siempre</h3>
            </div>
            <nav class="sidebar-nav">
                <ul>
                    <li><a href="../dashboard.php">Dashboard</a></li>
                    <li><a href="../noticias/noticias.php">Gestionar Noticias</a></li>
                    <li><a href="opiniones.php" class="active">Gestión de Opiniones</a></li>
                    <li><a href="../historia/historia.php">Gestión de Historia</a></li>
                    <li><a href="../tabla_posiciones/tabla_posiciones.php">Gestionar Posiciones</a></li>
                    <li class="divider"></li>
                    <li><a href="../../?logout=1" class="logout">Cerrar Sesión</a></li>
                </ul>
            </nav>
        </aside>

        <!-- CONTENIDO PRINCIPAL -->
        <main class="admin-content">
            <!-- TOP BAR -->
            <div class="admin-topbar">
                <h1>Gestión de Opiniones</h1>
                <div class="user-info">
                    <span><?php echo htmlspecialchars($usuario['nombre']); ?></span>
                    <small><?php echo ucfirst($usuario['rol']); ?></small>
                </div>
            </div>

            <!-- CONTENIDO -->
            <div class="admin-body">
                <div class="noticias-header">
                    <button class="btn-primary" onclick="abrirModalAdmin('modalCrearOpinion', 'crear')">
                        Crear Nueva Opinión
                    </button>
                </div>

                <!-- TABLA DE OPINIONES -->
                <div class="table-container">
                    <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Título</th>
                            <th>Autor</th>
                            <th>Estado</th>
                            <th>Fecha</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="tabla-opiniones">
                        <?php if (!empty($opiniones)): ?>
                            <?php foreach ($opiniones as $opinion): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars(substr($opinion['titulo'], 0, 40)); ?></td>
                                    <td><?php echo htmlspecialchars($opinion['nombre']); ?></td>
                                    <td><span class="badge badge-<?php echo $opinion['estado']; ?>"><?php echo ucfirst($opinion['estado']); ?></span></td>
                                    <td><?php echo date('d/m/Y H:i', strtotime($opinion['fecha_creacion'])); ?></td>
                                    <td>
                                        <div class="acciones">
                                            <button class="btn-action btn-secondary" onclick="abrirModalAdmin('modalVerOpinion', 'ver', <?php echo $opinion['id']; ?>)">Ver</button>
                                            <button class="btn-action btn-primary" onclick="abrirModalAdmin('modalEditarOpinion', 'editar', <?php echo $opinion['id']; ?>)">Editar</button>
                                            <button class="btn-action btn-danger" onclick="abrirModalConfirmacion('eliminar_opinion', <?php echo $opinion['id']; ?>, '<?php echo htmlspecialchars($opinion['titulo']); ?>')">Eliminar</button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center">No hay opiniones registradas</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <!-- MODALES -->
    <div id="modalCrearOpinion" class="modal">
        <div class="modal-content modal-lg">
            <span class="close-modal" onclick="cerrarModalAdmin('modalCrearOpinion')">&times;</span>
            <h2>Crear Nueva Opinión</h2>
            <form id="formCrearOpinion" method="POST" action="opiniones.php" class="admin-form" enctype="multipart/form-data" onsubmit="event.preventDefault(); enviarFormularioAdmin(this, recargarTablaOpiniones);">
                <input type="hidden" name="accion" value="crear">
                
                <div class="form-group">
                    <label for="titulo">Título:</label>
                    <input type="text" id="titulo" name="titulo" required>
                </div>

                <div class="form-group">
                    <label for="contenido">Contenido:</label>
                    <textarea id="contenido" name="contenido" required></textarea>
                </div>

                <div class="form-group">
                    <label for="imagen">Imagen:</label>
                    <div class="preview-container">
                        <div id="preview-crear" class="imagen-preview-placeholder">Vista previa</div>
                    </div>
                    <input type="file" id="imagen" name="imagen" accept="image/*" onchange="previewImage(event)">
                    <small style="color: #718096;">Formatos aceptados: JPG, PNG, GIF. Tamaño máximo: 5MB</small>
                </div>

                <div class="form-group">
                    <label for="pie_foto">Pie de foto:</label>
                    <input type="text" id="pie_foto" name="pie_foto" placeholder="Ej: Autor de la imagen, créditos, descripción...">
                </div>

                <div class="form-group">
                    <label for="estado">Estado:</label>
                    <select id="estado" name="estado">
                        <option value="borrador">Borrador</option>
                        <option value="publicado">Publicado</option>
                    </select>
                </div>

                <button type="submit" class="btn-primary">Crear Opinión</button>
            </form>
        </div>
    </div>

    <div id="modalVerOpinion" class="modal">
        <div class="modal-content modal-lg">
            <span class="close-modal" onclick="cerrarModalAdmin('modalVerOpinion')">&times;</span>
            <div class="modal-body">
                <!-- Se cargará vía AJAX -->
            </div>
        </div>
    </div>

    <div id="modalEditarOpinion" class="modal">
        <div class="modal-content modal-lg">
            <span class="close-modal" onclick="cerrarModalAdmin('modalEditarOpinion')">&times;</span>
            <h2>Editar Opinión</h2>
            <div class="modal-body">
                <!-- Se cargará vía AJAX -->
            </div>
        </div>
    </div>

    <div id="modalConfirmacion" class="modal">
        <div class="modal-content modal-confirm">
            <h2 id="confirmTitulo">Confirmar Eliminación</h2>
            <p id="confirmMensaje">¿Estás seguro de que deseas eliminar esto?</p>
            <div class="modal-actions">
                <button class="btn-cancel" onclick="cerrarModalAdmin('modalConfirmacion')">Cancelar</button>
                <button id="btnConfirmarEliminacion" class="btn-danger">Eliminar</button>
            </div>
        </div>
    </div>

    <script src="../../assets/js/admin/admin.js"></script>
    <script>
        // ===== FUNCIONES DE CONFIRMACIÓN Y RECARGA =====
        function abrirModalConfirmacion(tipo, id, titulo) {
            const modal = document.getElementById('modalConfirmacion');
            const confirmTitulo = document.getElementById('confirmTitulo');
            const confirmMensaje = document.getElementById('confirmMensaje');
            const btnConfirmar = document.getElementById('btnConfirmarEliminacion');
            
            confirmTitulo.textContent = 'Confirmar Eliminación';
            confirmMensaje.textContent = `¿Estás seguro de que deseas eliminar "${titulo}"?`;
            
            // Limpiar evento anterior
            btnConfirmar.onclick = null;
            
            // Agregar nuevo evento
            btnConfirmar.onclick = function() {
                eliminarOpinion(id);
            };
            
            abrirModalAdmin('modalConfirmacion');
        }

        function eliminarOpinion(id) {
            const formData = new FormData();
            formData.append('accion', 'eliminar');
            formData.append('id', id);

            fetch('opiniones.php', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.exito) {
                        mostrarAlertaAdmin('success', data.mensaje);
                        cerrarModalAdmin('modalConfirmacion');
                        setTimeout(recargarTablaOpiniones, 1500);
                    } else {
                        mostrarAlertaAdmin('error', data.mensaje);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    mostrarAlertaAdmin('error', 'Error al eliminar la opinión');
                });
        }

        function recargarTablaOpiniones() {
            fetch('?accion=obtener_tabla')
                .then(response => response.text())
                .then(html => {
                    const tabla = document.querySelector('tbody');
                    if (tabla) {
                        tabla.innerHTML = html;
                    }
                    cerrarModalAdmin('modalCrearOpinion');
                })
                .catch(error => {
                    console.error('Error:', error);
                    mostrarAlertaAdmin('error', 'Error al recargar la tabla');
                });
        }

        // ===== VISTA PREVIA DE IMAGEN =====
        function previewImage(event) {
            const file = event.target.files[0];
            const previewDiv = document.getElementById('preview-crear');
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewDiv.innerHTML = '<img src="' + e.target.result + '" alt="Vista previa" class="imagen-preview">';
                };
                reader.readAsDataURL(file);
            } else {
                previewDiv.innerHTML = '';
            }
        }

        function previewImageEditar(event) {
            const file = event.target.files[0];
            const previewDiv = document.getElementById('preview-editar');
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewDiv.innerHTML = '<img src="' + e.target.result + '" alt="Vista previa" class="imagen-preview">';
                };
                reader.readAsDataURL(file);
            }
        }
        
        // Toggle Sidebar para móvil
        function toggleSidebar() {
            const sidebar = document.getElementById('adminSidebar');
            const overlay = document.getElementById('sidebarOverlay');
            const toggleBtn = document.getElementById('sidebarToggle');
            
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
            toggleBtn.classList.toggle('sidebar-open');
            
            const icon = toggleBtn.querySelector('i');
            if (sidebar.classList.contains('active')) {
                icon.classList.remove('fa-bars');
                icon.classList.add('fa-times');
            } else {
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            }
        }
        
        function closeSidebar() {
            const sidebar = document.getElementById('adminSidebar');
            const overlay = document.getElementById('sidebarOverlay');
            const toggleBtn = document.getElementById('sidebarToggle');
            const icon = toggleBtn.querySelector('i');
            
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
            toggleBtn.classList.remove('sidebar-open');
            icon.classList.remove('fa-times');
            icon.classList.add('fa-bars');
        }
        
        document.querySelectorAll('.sidebar-nav a').forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth <= 768) closeSidebar();
            });
        });
        
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closeSidebar();
        });
    </script>
</body>
</html>