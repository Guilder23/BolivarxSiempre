<?php
// ===== NAVBAR INCLUIBLE PARA TODAS LAS PÁGINAS =====
// Incluir en todas las páginas: <?php include 'navbar.php'; ?>

<!-- Font Awesome para iconos -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="assets/css/social-media.css">

<nav class="navbar-fixed">
    <div class="logo">Bolívar por Siempre</div>
    
    <!-- Botón Hamburguesa -->
    <button class="hamburger-btn" id="hamburgerBtn" onclick="toggleMenu()" aria-label="Abrir menú">
        <span class="hamburger-line"></span>
        <span class="hamburger-line"></span>
        <span class="hamburger-line"></span>
    </button>
    
    <!-- Overlay para cerrar menú al hacer clic fuera -->
    <div class="nav-overlay" id="navOverlay" onclick="closeMenu()"></div>
    
    <ul class="nav-menu" id="navMenu">
        <li><a href="index.php">Inicio</a></li>
        <li><a href="mision.php">Misión y Visión</a></li>
        <li><a href="opinion.php">Opinión</a></li>
        <li><a href="sugerencias.php">Sugerencias</a></li>
        <li><a href="destacado.php">Lo Último</a></li>
        <li><a href="historia.php">Historia</a></li>
        <li><a href="tabla.php">Tabla</a></li>
        <?php if(estoy_autenticado()): ?>
            <li><a href="admin/dashboard.php" class="nav-admin-link">Admin</a></li>
            <li><a href="includes/auth.php?logout=1">Salir</a></li>
        <?php else: ?>
            <li><a href="#" class="btn-login" onclick="abrirModalLogin(event)">Login</a></li>
        <?php endif; ?>
    </ul>
</nav>

<!-- Script del menú hamburguesa -->
<script>
function toggleMenu() {
    const navMenu = document.getElementById('navMenu');
    const hamburgerBtn = document.getElementById('hamburgerBtn');
    const navOverlay = document.getElementById('navOverlay');
    
    navMenu.classList.toggle('active');
    hamburgerBtn.classList.toggle('active');
    navOverlay.classList.toggle('active');
    document.body.classList.toggle('menu-open');
}

function closeMenu() {
    const navMenu = document.getElementById('navMenu');
    const hamburgerBtn = document.getElementById('hamburgerBtn');
    const navOverlay = document.getElementById('navOverlay');
    
    navMenu.classList.remove('active');
    hamburgerBtn.classList.remove('active');
    navOverlay.classList.remove('active');
    document.body.classList.remove('menu-open');
}

// Cerrar menú al hacer clic en un enlace
document.querySelectorAll('.nav-menu a').forEach(link => {
    link.addEventListener('click', () => {
        if (window.innerWidth <= 768) {
            closeMenu();
        }
    });
});

// Cerrar menú con tecla Escape
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
        closeMenu();
    }
});
</script>

<!-- Modal de Login Mejorado -->
<div id="loginModal" class="modal">
    <div class="modal-content modal-login">
        <span class="close" onclick="cerrarModalLogin()">&times;</span>
        <div class="login-header">
            <h3>Acceso Administrativo</h3>
            <p>Panel de Control - Bolivar por siempre</p>
        </div>
        <form id="formLogin" method="POST" action="includes/auth.php" class="form-login">
            <input type="hidden" name="accion" value="login">
            <div class="form-group">
                <label for="usuario">Usuario:</label>
                <input type="text" id="usuario" name="usuario" placeholder="Ingrese su usuario" required>
            </div>
            <div class="form-group">
                <label for="contrasena">Contraseña:</label>
                <input type="password" id="contrasena" name="contrasena" placeholder="Ingrese su contraseña" required>
            </div>
            <button type="submit" class="btn-login-submit">Iniciar Sesión</button>
        </form>
        <div id="mensajeLogin" class="mensaje-login"></div>
    </div>
</div>

<style>
    .modal-login {
        min-width: 380px;
        border-radius: 12px;
        box-shadow: 0 15px 50px rgba(0, 0, 0, 0.3);
        background: white;
        overflow: hidden;
    }

    .login-header {
        background: linear-gradient(135deg, #1e3a5f 0%, #5a7bb7 100%);
        color: white;
        padding: 30px 25px;
        text-align: center;
    }

    .login-header h2 {
        margin: 0;
        font-size: 1.6em;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .login-header p {
        margin: 0;
        font-size: 0.95em;
        opacity: 0.9;
    }

    .form-login {
        padding: 30px 25px;
    }

    .form-login .form-group {
        margin-bottom: 20px;
    }

    .form-login label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #1e3a5f;
        font-size: 0.95em;
    }

    .form-login input {
        width: 100%;
        padding: 12px 15px;
        border: 2px solid #e2e8f0;
        border-radius: 8px;
        font-size: 1em;
        font-family: 'Montserrat', sans-serif;
        transition: all 0.3s ease;
    }

    .form-login input:focus {
        outline: none;
        border-color: #5a7bb7;
        box-shadow: 0 0 0 3px rgba(90, 123, 183, 0.1);
    }
     .btn-login{
        text-decoration: none;
        color: white !important;
        font-weight: 600;
        padding: 8px 16px;
        border-radius: 6px;
        background: linear-gradient(135deg, #5a7bb7, #1e3a5f);
     }
     .btn-login:hover{
        background: linear-gradient(135deg, #1e3a5f, #5a7bb7) !important;
     }
     .btn-login:active{
        transform: translateY(0);
     }
     
    .btn-login-submit {
        width: 100%;
        padding: 12px 20px;
        background: linear-gradient(135deg, #5a7bb7, #1e3a5f);
        color: white !important;
        border: none;
        border-radius: 8px;
        font-size: 1.05em;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-top: 10px;
    }

    .btn-login-submit:hover {
        transform: translateY(-2px);
        background: linear-gradient(135deg, #1e3a5f, #5a7bb7) !important;
        box-shadow: 0 8px 20px rgba(30, 58, 95, 0.3);
    }

    .btn-login-submit:active {
        transform: translateY(0);
    }

    .mensaje-login {
        margin-top: 15px;
        padding: 12px 15px;
        border-radius: 8px;
        font-size: 0.95em;
        text-align: center;
    }

    .mensaje-login.error {
        background-color: #fee;
        color: #c33;
        border: 1px solid #fcc;
    }

    .mensaje-login.success {
        background-color: #efe;
        color: #3c3;
        border: 1px solid #cfc;
    }
</style>
