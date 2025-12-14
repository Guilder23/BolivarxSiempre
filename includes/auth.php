<?php
// Incluir configuración
require_once __DIR__ . '/../config/database.php';

// ===== PROCESAR LOGIN =====
$error_login = '';
$login_exitoso = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion']) && $_POST['accion'] === 'login') {
    $usuario = isset($_POST['usuario']) ? trim($_POST['usuario']) : '';
    $contrasena = isset($_POST['contrasena']) ? $_POST['contrasena'] : '';
    
    if (empty($usuario) || empty($contrasena)) {
        $error_login = 'Usuario y contraseña son requeridos.';
    } else {
        // ===== VALIDAR CONTRA LA BASE DE DATOS =====
        if ($conn) {
            // Escapar usuario para seguridad
            $usuario_escapado = $conn->real_escape_string($usuario);
            
            // Buscar el usuario en la BD
            $query = "SELECT id, nombre, usuario, contrasena, rol, estado FROM usuarios WHERE usuario = '$usuario_escapado' AND estado = 'activo'";
            $resultado = $conn->query($query);
            
            if ($resultado && $resultado->num_rows > 0) {
                $datos_usuario = $resultado->fetch_assoc();
                
                // Verificar la contraseña (en texto plano por ahora)
                if ($datos_usuario['contrasena'] === $contrasena) {
                    // Login exitoso
                    $_SESSION['usuario_id'] = $datos_usuario['id'];
                    $_SESSION['usuario_nombre'] = $datos_usuario['nombre'];
                    $_SESSION['usuario_usuario'] = $datos_usuario['usuario'];
                    $_SESSION['usuario_rol'] = $datos_usuario['rol'];
                    $_SESSION['autenticado'] = true;
                    $login_exitoso = true;
                    
                    // Redirigir según rol
                    if ($datos_usuario['rol'] === 'admin') {
                        header('Location: ../admin/dashboard.php');
                        exit();
                    } else {
                        header('Location: ../index.php');
                        exit();
                    }
                } else {
                    $error_login = 'Contraseña incorrecta.';
                }
            } else {
                $error_login = 'Usuario no encontrado.';
            }
        } else {
            $error_login = 'Error de conexión con la base de datos.';
        }
    }
    
    // Si hay error, redirigir de vuelta al index con el mensaje
    if (!$login_exitoso && $error_login) {
        $_SESSION['error'] = $error_login;
        header('Location: ../index.php');
        exit();
    }
}

// ===== PROCESAR LOGOUT =====
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: ../index.php');
    exit();
}
?>