document.addEventListener('DOMContentLoaded', function() {
    eventListeners();

    darkMode();
});


function eventListeners() {
    const mobileMenu = document.querySelector('.mobile-menu');

    mobileMenu.addEventListener('click', navegacionResponsive);

    // Mostrar campos condicionales
    const metodoContacto = document.querySelectorAll('input[name="contacto"]');

    metodoContacto.forEach(input => input.addEventListener('click', mostrarMetodoContacto));
};

function navegacionResponsive() {
    const navegacion = document.querySelector('.navegacion');

    navegacion.classList.toggle('mostrar');

};

function darkMode() {

    // Lógica para tomar el tema del sistema y automaticamente colocar el modo oscuro en la pagina
    // const SODarkMode = window.matchMedia('(prefers-color-scheme: dark)');

    // if (SODarkMode.matches) {
    //     document.body.classList.add('dark-mode');
    // } else {
    //     document.body.classList.remove('dark-mode');
    // }

    // SODarkMode.addEventListener('change', function() {
    //     if (SODarkMode.matches) {
    //         document.body.classList.add('dark-mode');
    //     } else {
    //         document.body.classList.remove('dark-mode');
    //     }
    // })

    const botonDarkMode = document.querySelector('.dark-mode-boton');

    botonDarkMode.addEventListener('click', function () {
        document.body.classList.toggle('dark-mode');
    })
}

function mostrarMetodoContacto(e) {
    const contactoDiv = document.querySelector('#contacto');

    if(e.target.value === 'telefono') {
        contactoDiv.innerHTML = `
            <br>
            <input type="tel" placeholder="Tu Teléfono" id="" name="telefono" required>
            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="fecha">
            <label for="hora">Hora:</label>
            <input type="time" id="hora" min="09:00" max="18:00" name="hora">
        `;
    } else {
        contactoDiv.innerHTML = `
            <br>
            <input type="email" placeholder="Tu Email" id="email" name="email" required>
        `;
    }
}