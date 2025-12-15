<div class="modal-view">
    <h2><?php echo htmlspecialchars($opinion['titulo']); ?></h2>
    
    <?php if ($opinion['imagen']): ?>
        <figure class="modal-figure">
            <img src="../../assets/img/opiniones/<?php echo htmlspecialchars($opinion['imagen']); ?>" alt="<?php echo htmlspecialchars($opinion['titulo']); ?>" class="modal-image">
            <?php if (!empty($opinion['pie_foto'])): ?>
                <figcaption class="pie-foto"><?php echo htmlspecialchars($opinion['pie_foto']); ?></figcaption>
            <?php endif; ?>
        </figure>
    <?php endif; ?>
    
    <div class="modal-info">
        <p><strong>Autor:</strong> <?php echo htmlspecialchars($opinion['autor']); ?></p>
        <p><strong>Estado:</strong> <span class="estado-badge estado-<?php echo strtolower($opinion['estado']); ?>"><?php echo ucfirst($opinion['estado']); ?></span></p>
        <p><strong>Fecha de creación:</strong> <?php echo date('d/m/Y H:i', strtotime($opinion['fecha_creacion'])); ?></p>
        <?php if ($opinion['fecha_publicacion']): ?>
            <p><strong>Fecha de publicación:</strong> <?php echo date('d/m/Y H:i', strtotime($opinion['fecha_publicacion'])); ?></p>
        <?php endif; ?>
    </div>
    
    <div class="modal-content">
        <?php echo nl2br(htmlspecialchars($opinion['contenido'])); ?>
    </div>
</div>
