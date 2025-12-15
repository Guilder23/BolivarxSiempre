<form method="POST" action="historia.php" class="admin-form" enctype="multipart/form-data" onsubmit="event.preventDefault(); enviarFormularioAdmin(this, recargarTablaHistorias);">
    <input type="hidden" name="accion" value="editar">
    <input type="hidden" name="id" value="<?php echo $historia['id']; ?>">
    
    <div class="form-group">
        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" value="<?php echo htmlspecialchars($historia['titulo']); ?>" required>
    </div>

    <div class="form-group">
        <label for="contenido">Contenido:</label>
        <textarea id="contenido" name="contenido" required><?php echo htmlspecialchars($historia['contenido']); ?></textarea>
    </div>

    <div class="form-group">
        <label for="imagen">Imagen:</label>
        <div class="preview-container">
            <?php if ($historia['imagen']): ?>
                <img id="preview-editar" src="../../assets/img/historia/<?php echo htmlspecialchars($historia['imagen']); ?>" alt="Imagen actual" class="imagen-preview">
            <?php else: ?>
                <div id="preview-editar" class="imagen-preview-placeholder">Sin imagen</div>
            <?php endif; ?>
        </div>
        <input type="file" id="imagen" name="imagen" accept="image/*" onchange="previewImageEditar(event)">
        <small style="color: #718096;">JPG, PNG o GIF (máximo 5MB)</small>
    </div>

    <div class="form-group">
        <label for="estado">Estado:</label>
        <select id="estado" name="estado" required>
            <option value="borrador" <?php echo $historia['estado'] === 'borrador' ? 'selected' : ''; ?>>Borrador</option>
            <option value="publicado" <?php echo $historia['estado'] === 'publicado' ? 'selected' : ''; ?>>Publicado</option>
            <option value="cancelado" <?php echo $historia['estado'] === 'cancelado' ? 'selected' : ''; ?>>Cancelado</option>
        </select>
    </div>

    <button type="submit" class="btn-primary">Actualizar Historia</button>
</form>
