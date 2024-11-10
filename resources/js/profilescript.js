document.addEventListener('DOMContentLoaded', () => {
    const contador = document.getElementById('contador');
    let seguidores = document.getElementById('CountFollowers').innerText;
    let velocidad = Math.floor(seguidores / 100);

    const actualizarContador = () => {
        let conteoActual = parseInt(contador.innerText);

        if (conteoActual < seguidores) {
            contador.innerText = conteoActual + velocidad;
            setTimeout(actualizarContador, 5);  // Ajusta la velocidad aquí
        } else {
            contador.innerText = seguidores;
            contador.classList.add('zoom'); 
        }
    };

    actualizarContador();
});

document.addEventListener('DOMContentLoaded', () => {
    const contador = document.getElementById('contadorfollow');
    let seguidores = document.getElementById('CountFollowed').innerText;
    let velocidad = Math.floor(seguidores / 100);

    const actualizarContador = () => {
        let conteoActual = parseInt(contador.innerText);

        if (conteoActual < seguidores) {
            contador.innerText = conteoActual + velocidad;
            setTimeout(actualizarContador, 5);  // Ajusta la velocidad aquí
        } else {
            contador.innerText = seguidores;
            contador.classList.add('zoom'); 
        }
    };

    actualizarContador();
});
  

function abreseguidores(){
    document.getElementById('blacki').style.display = 'block';
    document.querySelector('.followersss').style.display = 'flex';
}

function cierraseguidores() {
    document.getElementById('blacki').style.display = 'none';
    document.querySelector('.followersss').style.display = 'none';
}

// Abre el modal cuando se hace clic en el botón .followers
document.querySelector('.followers').addEventListener('click', abreseguidores);

// Cierra el modal cuando se hace clic en el botón .atrasmodal
document.querySelector('.atrasmodal').addEventListener('click', cierraseguidores);

// Cierra el modal cuando se hace clic fuera del modal
document.addEventListener('click', function(event) {
    const modal = document.querySelector('.followersss');
    if (modal.style.display === 'flex' && !modal.contains(event.target) && !document.querySelector('.followers').contains(event.target)) {
        cierraseguidores();
    }

function abreseguidos() {
    document.getElementById('blacki').style.display = 'block';
    document.querySelector('.follows').style.display = 'flex';
}

// Abre el modal cuando se hace clic en el botón .followed
document.querySelectorAll('.followed').forEach(button => {
    button.addEventListener('click', abreseguidos);
});

// Cierra el modal cuando se hace clic en el botón .atrasmodal
document.querySelectorAll('.atrasmodal').forEach(button => {
    button.addEventListener('click', cierraseguidores);
});

// Cierra el modal cuando se hace clic fuera del modal
document.addEventListener('click', function(event) {
    const modal = document.querySelector('.follows');
    if (modal.style.display === 'flex' && !modal.contains(event.target) && !event.target.matches('.followed')) {
        cierraseguidores();
    }
});

});
function cierraseguidos() {
    document.getElementById('blacki').style.display = 'none';
    document.querySelector('.follows').style.display = 'none';
}

function abreseguidos() {
    document.getElementById('blacki').style.display = 'block';
    document.querySelector('.follows').style.display = 'flex';
}

// Abre el modal cuando se hace clic en el botón .followed
document.querySelectorAll('.followed').forEach(button => {
    button.addEventListener('click', abreseguidos);
});

// Cierra el modal cuando se hace clic en el botón .atrasmodal
document.querySelectorAll('.atrasmodal').forEach(button => {
    button.addEventListener('click', cierraseguidos);
});

// Cierra el modal cuando se hace clic fuera del modal
document.addEventListener('click', function(event) {
    const modal = document.querySelector('.follows');
    if (modal.style.display === 'flex' && !modal.contains(event.target) && !event.target.matches('.followed')) {
        cierraseguidos();
    }
});
