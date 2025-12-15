<div class="modal-view">
    <h2><?php echo htmlspecialchars($noticia['titulo']); ?></h2>
    
    <?php if (!empty($noticia['imagen'])): ?>
        <img src="../../assets/img/noticias/<?php echo htmlspecialchars($noticia['imagen']); ?>" alt="<?php echo htmlspecialchars($noticia['titulo']); ?>" class="modal-image">
    <?php endif; ?>
    
    <div class="modal-info">
        <p><strong>Autor:</strong> <?php echo htmlspecialchars($noticia['autor'] ?? 'Sin autor'); ?></p>
        <p><strong>Estado:</strong> <span class="estado-badge estado-<?php echo strtolower($noticia['estado']); ?>"><?php echo ucfirst($noticia['estado']); ?></span></p>
        <p><strong>Fecha de creación:</strong> <?php echo date('d/m/Y H:i', strtotime($noticia['fecha_creacion'])); ?></p>
        <?php if (!empty($noticia['fecha_publicacion'])): ?>
            <p><strong>Fecha de publicación:</strong> <?php echo date('d/m/Y H:i', strtotime($noticia['fecha_publicacion'])); ?></p>
        <?php endif; ?>
    </div>
    
    <div class="modal-content">
        <?php echo nl2br(htmlspecialchars($noticia['contenido'])); ?>
    </div>
</div>