<?php 

require 'includes/app.php';


incluirTemplate('header');
?>  
    
    <main class="contenedor seccion">
        <h1>Contacto</h1>

        <picture>
            <source srcset="build/img/destacada3.webp" type="image/webp">
            <source srcset="build/img/destacada3.jpg" type="image/jpeg">
            <img src="build/img/destacada3.jpg" loading="lazy" alt="Contacto">
        </picture>

        <h2>Llene el formulario de Contacto</h2>

        <form class="formulario">
            <fieldset>
                <legend>Informacion personal</legend>
                
                <label for="nombre">Nombre:</label>
                <input type="text" placeholder="Tu Nombre" id="nombre">

                <label for="email">E-mail:</label>
                <input type="email" placeholder="Tu E-mail" id="email">

                <label for="telefono">Teléfono:</label>
                <input type="tel" placeholder="Tu Teléfono" id="telefono">

                <label for="mensaje">Mensaje:</label>
                <textarea id="mensaje"></textarea>
             </fieldset>


            <fieldset>
                <legend>Informacion sobre propiedad</legend>
               
                <label for="opciones">Vende o compra:</label>
                <select id="opciones">
                    <option value disabled selected>Selecciona una opción:</option>
                    <option value="compra">Compra</option>
                    <option value="vende">Vende</option>
                </select>
               
                <label for="presupuesto">Tu precio o presupuesto</label>
                <input type="number" placeholder="Tu precio o presupuesto" id="presupuesto">
            </fieldset>

            <fieldset>
                <legend>Programa tu próxima asesoría asesoria</legend>
                
                <p>¿Cómo desea ser contactado?</p>
                
                <div class="forma-contacto">
                    <label for="contactar-telefono">Teléfono</label>
                    <input name="contacto" type="radio" value="telefono" id="contactar-telefono">
                    
                    <label for="contactar-email">E-mail</label>
                    <input name="contacto" type="radio" value="email" id="contactar-email">
                </div>
                
                <p>Si eligió telefono, elija una fecha y hora</p>
                
                <label for="fecha">Fecha:</label>
                <input type="date" id="fecha">
                
                <label for="hora">Hora:</label>
                <input type="time" id="hora" min="09:00" max="18:00">
            </fieldset>

            <input class="boton-verde" type="submit" value="enviar" >
        </form>

        

    </main>

<?php 
  incluirTemplate('footer');
?>
