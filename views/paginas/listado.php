<div class="contenedor-anuncio">
    <?php foreach ($propiedades as $propiedad): ?>    
        <div class="anuncio">
            <img loading="lazy" width="200" height="300" src="/imagenes/<?php echo $propiedad->imagen; ?>" alt="anuncio">

            <div class="contenido-anuncio">
                <h3><?php echo $propiedad->titulo; ?></h3>
                <p><?php echo trim($propiedad->descripcion); ?></p>
                <p class="precio">
                    $<?php echo $propiedad->precio; ?>
                </p>

                <ul class="iconos-caracteristicas">
                    <li>
                        <img class="icono" src="build/img/icono_wc.svg" alt="" loading="lazy">
                        <p><?php echo $propiedad->wc; ?></p>
                    </li>
                    <li>
                        <img class="icono" src="build/img/icono_estacionamiento.svg" alt="" loading="lazy">
                        <p><?php echo $propiedad->estacionamiento; ?></p>
                    </li>
                    <li>
                        <img class="icono" src="build/img/icono_dormitorio.svg" alt="" loading="lazy">
                        <p><?php echo $propiedad->habitaciones; ?></p>
                    </li>
                </ul>

                <a href="propiedad?id=<?php echo $propiedad->id; ?>" class="boton boton-amarillo">
                    Ver propiedad
                </a>
            </div>
        </div>
    <?php endforeach; ?>
</div>