<form method="POST" action="opiniones.php" class="admin-form" enctype="multipart/form-data" onsubmit="event.preventDefault(); enviarFormularioAdmin(this, recargarTablaOpiniones);">
    <input type="hidden" name="accion" value="editar">
    <input type="hidden" name="id" value="<?php echo $opinion['id']; ?>">
    
    <div class="form-group">
        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" value="<?php echo htmlspecialchars($opinion['titulo']); ?>" required>
    </div>

    <div class="form-group">
        <label for="contenido">Contenido:</label>
        <textarea id="contenido" name="contenido" required><?php echo htmlspecialchars($opinion['contenido']); ?></textarea>
    </div>

    <div class="form-group">
        <label for="imagen">Imagen:</label>
        <div class="preview-container">
            <?php if ($opinion['imagen']): ?>
                <img id="preview-editar" src="../../assets/img/opiniones/<?php echo htmlspecialchars($opinion['imagen']); ?>" alt="Imagen actual" class="imagen-preview">
            <?php else: ?>
                <div id="preview-editar" class="imagen-preview-placeholder">Sin imagen</div>
            <?php endif; ?>
        </div>
        <input type="file" id="imagen" name="imagen" accept="image/*" onchange="previewImageEditar(event)">
        <small style="color: #718096;">JPG, PNG o GIF (máximo 5MB)</small>
    </div>

    <div class="form-group">
        <label for="pie_foto">Pie de foto:</label>
        <input type="text" id="pie_foto" name="pie_foto" value="<?php echo htmlspecialchars($opinion['pie_foto'] ?? ''); ?>" placeholder="Ej: Autor de la imagen, créditos, descripción...">
    </div>

    <div class="form-group">
        <label for="estado">Estado:</label>
        <select id="estado" name="estado" required>
            <option value="borrador" <?php echo $opinion['estado'] === 'borrador' ? 'selected' : ''; ?>>Borrador</option>
            <option value="publicado" <?php echo $opinion['estado'] === 'publicado' ? 'selected' : ''; ?>>Publicado</option>
            <option value="cancelado" <?php echo $opinion['estado'] === 'cancelado' ? 'selected' : ''; ?>>Cancelado</option>
        </select>
    </div>

    <button type="submit" class="btn-primary">Actualizar Opinión</button>
</form>
