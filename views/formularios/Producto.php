<div class="mb-3">
    <label for="nombre_producto" class="form-label">Nombre del Producto</label>
    <input 
        type="text" 
        class="form-control" 
        id="nombre_producto" 
        name="producto[nombre_producto]" 
        value="<?php echo s($producto->nombre_producto); ?>"
        required
    >
</div>

<div class="mb-3">
    <label for="codigo_producto" class="form-label">Código del Producto</label>
    <input 
        type="text" 
        class="form-control" 
        id="codigo_producto" 
        name="producto[codigo_producto]" 
        value="<?php echo s($producto->codigo_producto); ?>" 
        readonly
    >
</div>

<div class="mb-3">
    <label for="id_categoria" class="form-label">Categoría</label>
    <select 
        id="id_categoria" 
        name="producto[id_categoria]" 
        class="form-select" 
        required
    >
        <option disabled selected value="">-- Seleccione --</option>
        <?php foreach ($categorias as $categoria): ?>
            <option 
                value="<?php echo s($categoria->idcategoria_producto); ?>"
                <?php echo $producto->id_categoria == $categoria->idcategoria_producto ? 'selected' : ''; ?>
            >
                <?php echo s($categoria->titulo); ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>
<div class="mb-3">
    <label for="imagen" class="form-label">Imagen del Producto</label>
    <input type="file" class="form-control" id="imagen" name="producto[Foto]" accept="image/jpeg, image/png">
</div>
<?php if (!empty($producto->idproducto) && !empty($producto->Foto)): ?>
    <img width="200" height="200" src="/img/productos/<?php echo s($producto->Foto); ?>" alt="Foto de perfil">
<?php endif; ?>
<div class="mb-3">
    <label for="descripcion" class="form-label">Descripción</label>
    <textarea 
        class="form-control" 
        id="descripcion" 
        name="producto[descripcion]" 
        rows="3"
    ><?php echo s($producto->descripcion); ?></textarea>
</div>

<div class="mb-3">
    <label for="precio" class="form-label">Precio</label>
    <input 
        type="number" 
        step="0.01" 
        class="form-control" 
        id="precio" 
        name="producto[precio]" 
        value="<?php echo s($producto->precio); ?>"
        required
    >
</div>
