<div class="modal-view">
    <h2><?php echo htmlspecialchars($historia['titulo']); ?></h2>
    
    <?php if ($historia['imagen']): ?>
        <img src="../../assets/img/historia/<?php echo htmlspecialchars($historia['imagen']); ?>" alt="<?php echo htmlspecialchars($historia['titulo']); ?>" class="modal-image">
    <?php endif; ?>
    
    <div class="modal-info">
        <p><strong>Autor:</strong> <?php echo htmlspecialchars($historia['autor']); ?></p>
        <p><strong>Estado:</strong> <span class="estado-badge estado-<?php echo strtolower($historia['estado']); ?>"><?php echo ucfirst($historia['estado']); ?></span></p>
        <p><strong>Fecha de creación:</strong> <?php echo date('d/m/Y H:i', strtotime($historia['fecha_creacion'])); ?></p>
        <?php if ($historia['fecha_publicacion']): ?>
            <p><strong>Fecha de publicación:</strong> <?php echo date('d/m/Y H:i', strtotime($historia['fecha_publicacion'])); ?></p>
        <?php endif; ?>
    </div>
    
    <div class="modal-content">
        <?php echo nl2br(htmlspecialchars($historia['contenido'])); ?>
    </div>
</div>
