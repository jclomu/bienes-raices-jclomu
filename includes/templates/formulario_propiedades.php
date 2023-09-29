<fieldset>
          <legend>Información General</legend>

          <label for="titulo">Título</label>
          <input type="text" id="titulo" name="propiedad[titulo]" placeholder="Titulo propiedad" value="<?php echo s($propiedad->titulo); ?>">

          <label for="precio">Precio</label>
          <input type="number" id="precio" name="propiedad[precio]" placeholder="Precio propiedad"  min="0" value="<?php echo s($propiedad->precio); ?>">
          
          <label for="imagen">Imagen</label>
          <input type="file" id="imagen" accept="image/jpeg, image/png" name="propiedad[imagen]">
          
          <?php if($propiedad->imagen) { ?>
            <img src="/imagenes/<?php echo $propiedad->imagen ?>" class="img-thumb">
          
          <?php }?>
          <label for="descripcion">Descripción</label>
          <textarea id="descripcion" name="propiedad[descripcion]"><?php echo s($propiedad->descripcion); ?></textarea>
          
        </fieldset>

        <fieldset>
          <legend>Información de la propiedad</legend>

          <label for="habitaciones">Habitaciones</label>
          <input type="number" id="habitaciones" name="propiedad[habitaciones]" placeholder="ej: 3" min="1" max="10" value="<?php echo s($propiedad->habitaciones); ?>">

          <label for="wc">Baños</label>
          <input type="number" id="wc" name="propiedad[wc]" placeholder="ej: 2" min="1" max="10" value="<?php echo s($propiedad->wc); ?>">
          
          <label for="estacionamiento">Estacionamiento</label>
          <input type="number" id="estacionamiento" name="propiedad[estacionamiento]" placeholder="ej: 1" min="1" max="10" value="<?php echo s($propiedad->estacionamiento); ?>">
        </fieldset>

        <fieldset>
          <legend>Vendedor</legend>
<!-- 
          <select name="vendedores_id">
            
            <option value="">--Selecciona un vendedor--</option>
            <?php while( $vendedor= mysqli_fetch_assoc($resultado) ) : ?>
              <option <?php echo $vendedores_id === $vendedor['id'] ? 'selected' : '' ?> value="1"> 
                <?php echo $vendedor['nombre'] . " " . $vendedor['apellido'] ?> 
              </option>
            <?php endwhile; ?>
            
          </select> -->
        </fieldset>