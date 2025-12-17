// Función para compartir
function compartirPagina() {
    const urlActual = window.location.href;
    const titulo = document.title;
    const descripcion = document.querySelector('meta[name="description"]')?.getAttribute('content') || 'Bolivar por Siempre - Institución deportiva referente del país';

    // Usar Web Share API si está disponible (navegadores modernos)
    if (navigator.share) {
        navigator.share({
            title: titulo,
            text: descripcion,
            url: urlActual
        }).catch(err => console.log('Error al compartir:', err));
    } else {
        // Fallback: copiar URL al portapapeles
        navigator.clipboard.writeText(urlActual).then(() => {
            // Mostrar notificación
            mostrarNotificacion('URL copiada al portapapeles');
        }).catch(err => {
            // Si todo falla, mostrar un alert
            alert('Compartir URL:\n' + urlActual);
        });
    }
}

// Función para compartir en una app específica (Facebook, Instagram, TikTok)
function compartirEnApp(app) {
    const urlActual = window.location.href;
    const titulo = document.title;
    const texto = `🔵⚪ Bolivar por Siempre - Institución deportiva referente del país\n\n${urlActual}`;

    // Configuración de URLs para cada app
    const appConfig = {
        facebook: {
            webFallback: `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(urlActual)}&quote=${encodeURIComponent(texto)}`,
            nombre: 'Facebook'
        },
        instagram: {
            webFallback: `https://www.instagram.com/`,
            nombre: 'Instagram'
        },
        tiktok: {
            webFallback: `https://www.tiktok.com/`,
            nombre: 'TikTok'
        }
    };

    const config = appConfig[app];
    if (!config) return;

    // Detectar si es móvil
    const isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);

    if (isMobile && navigator.share) {
        // En móvil usar Web Share API - abre el selector de apps
        navigator.share({
            title: titulo,
            text: texto,
            url: urlActual
        }).catch(err => {
            console.log('Compartir cancelado o error:', err);
        });
    } else {
        // En escritorio: copiar al portapapeles y abrir la red social
        navigator.clipboard.writeText(texto).then(() => {
            mostrarNotificacion(`✅ Enlace copiado. Pégalo en ${config.nombre} (Ctrl+V)`);
            // Abrir la red social después de copiar
            setTimeout(() => {
                window.open(config.webFallback, '_blank');
            }, 500);
        }).catch(err => {
            // Si falla el clipboard, solo abrir la red social
            mostrarNotificacion(`Abriendo ${config.nombre}...`);
            window.open(config.webFallback, '_blank');
        });
    }
}

// Función para mostrar notificación
function mostrarNotificacion(mensaje) {
    const notificacion = document.createElement('div');
    notificacion.textContent = mensaje;
    notificacion.style.cssText = `
        position: fixed;
        bottom: 20px;
        right: 20px;
        background: linear-gradient(135deg, #5a7bb7, #1e3a5f);
        color: white;
        padding: 12px 20px;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        font-weight: 600;
        z-index: 9999;
        animation: slideIn 0.3s ease;
    `;

    document.body.appendChild(notificacion);

    // Eliminar la notificación después de 3 segundos
    setTimeout(() => {
        notificacion.style.animation = 'slideOut 0.3s ease';
        setTimeout(() => notificacion.remove(), 300);
    }, 3000);
}

// Agregar estilos de animación
const style = document.createElement('style');
style.textContent = `
    @keyframes slideIn {
        from {
            transform: translateX(400px);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    @keyframes slideOut {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(400px);
            opacity: 0;
        }
    }
`;
document.head.appendChild(style);
