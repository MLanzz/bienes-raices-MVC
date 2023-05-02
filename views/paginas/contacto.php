<main class="contenedor seccion">
    <h1>Contacto</h1>
    <picture>
        <source srcset="build/img/destacada3.webp" type="image/webp">
        <source srcset="build/img/destacada3.jpg" type="image/jpeg">
        <img loading="lazy" src="build/img/destacada3.jpg" alt="Imagen destacada">
    </picture>
    <h2>Llene el formulario de Contacto</h2>

    <form class="formulario" action="/contacto" method="post">

        <fieldset>
            <legend>
                Información Personal
            </legend>
            <label for="">Nombre</label>
            <input type="text" placeholder="Tu Nombre" id="nombre" name="nombre" required>
            <label for="">E-mail</label>
            <input type="email" placeholder="Tu Email" id="email" name="apellido" required>
            <label for="">Teléfono</label>
            <input type="tel" placeholder="Tu Teléfono" id="" name="telefono" required>
            <label for="">Mensaje:</label>
            <textarea id="mensaje" name="mensaje" required></textarea>
        </fieldset>
        <fieldset>
            <legend>
                Información sobre la propiedad
            </legend>
            <label for="">Vende o compra</label>
            <select id="opciones" name="tipo" required>
                <option value="" disabled selected>-- Seleccione --</option>
                <option value="Compra">Compra</option>
                <option value="Vende">Vende</option>
            </select>
            <label for="">Precio o presupuesto</label>
            <input type="text" placeholder="Tu Precio o Presupuesto" id="presupuesto" name="presupuesto" required>
        </fieldset>
        <fieldset>
            <legend>
                Información sobre la propiedad
            </legend>
            <p>Como desea ser contactado</p>

            <div class="forma-contacto">
                <label for="contactar-telefono">Teléfono</label>
                <input type="radio" name="contacto" value="telefono" id="contactar-telefono" required>
                <label for="contactar-email">E-mail</label>
                <input type="radio" name="contacto" value="email" id="contactar-email" required>
            </div>

            <p>Si eligió teléfono, elija la fecha y la hora</p>
            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="fecha">
            <label for="hora">Hora:</label>
            <input type="time" id="hora" min="09:00" max="18:00" name="hora">
        </fieldset>

        <input type="submit" class="boton-verde" value="Enviar">

    </form>
</main>