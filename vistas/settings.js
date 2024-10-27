//codigo del dropdown

document.querySelector('.lenguage').addEventListener('click', function() {
    document.querySelector('.dropdown-content').classList.toggle('show');
});

window.onclick = function(event) {
    if (!event.target.matches('.lenguage')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        for (var i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
}

const company = document.getElementById('com');
const user = document.querySelector('.text');
const suscri = document.querySelector('.boton-card');
const check = document.querySelector('.mora');
const card = document.querySelector('.card')
const li = document.querySelectorAll('.pichi')
let estasuscrito = true;
const tit = document.querySelector('.title');
const divusuario = document.getElementById('user');
const divcompany = document.querySelector(".wrapper-company");

divusuario.style.display = 'flex';
divcompany.style.display = 'none';

suscri.addEventListener('click', () => {
    if (estasuscrito) {
        suscri.innerHTML = "Cancelar Suscripción ";
        suscri.style.fontSize = 'medium';
        suscri.style.backgroundColor = '#151515';
        suscri.style.color = '#fff';
        suscri.style.border = 'none';
        card.style.background = 'linear-gradient(45deg,  #d90ff4, rgb(255,143,238), rgb(255,220,255), rgb(202, 128, 255), #99bdff, #80acff)';
        check.style.color = 'rgb(161,0,161)';
        li.forEach((ele) => {
            ele.style.color = 'rgb(161,0,161)';
        });
    } else {
        suscri.innerHTML = "Suscribirse";
        suscri.style.fontSize = '';
        suscri.style.backgroundColor = '';
        suscri.style.color = '';
        suscri.style.border = '';
        card.style.background = '';
        check.style.color = '';
        li.forEach((ele) => {
            ele.style.color = '';
        });
    }
    estasuscrito = !estasuscrito;
});

const espa  = document.getElementById('es');
const ing = document.getElementById('en');

let result = document.querySelector('.result');


espa.addEventListener('click',() =>{
    result.innerHTML = "idioma español";
})

ing.addEventListener('click',() =>{
    result.innerHTML = "English lenguage";
})


company.addEventListener('click', ()=>{
    company.style.color = '#fff';
    user.style.color = 'dimgray';
    tit.innerHTML = 'Settings of company';
    divusuario.style.display = 'none';
    divcompany.style.display = 'flex';


})

user.addEventListener('click', ()=>{
    user.style.color = '#fff';
    tit.innerHTML = 'Settings';
    company.style.color = 'dimgray';
    divusuario.style.display = 'flex';
    divcompany.style.display = 'none';
});

const togglePasswordBtn = document.getElementById('toggle-password');
const passwordInput = document.getElementById('password'); // Asegúrate de tener esta línea

togglePasswordBtn.addEventListener('click', () => {
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
    } else {
        passwordInput.type = 'password';
    }
});

const toggleButtons = document.querySelectorAll(".toggle-button");

toggleButtons.forEach((toggleButton) => {
    toggleButton.addEventListener("click", (event) => {
        event.stopPropagation();
        console.log('Toggle button clicked'); // Evita que el evento se propague
        
        if (toggleButton.innerText === "Activo") {
            toggleButton.innerText = "Desactivado";
            toggleButton.classList.add("inactive");
        } else {
            toggleButton.innerText = "Activo";
            toggleButton.classList.remove("inactive");
        }
    });
});


document.querySelectorAll('.miformula').forEach((eje) => {
    eje.addEventListener('submit', (event) => {
        event.preventDefault(); // Evita que se envíe el formulario
    });
});




document.addEventListener('DOMContentLoaded', () => {
    const botonCuenta = document.querySelector('.closer');
    const inputs = document.querySelectorAll('.user-settings input');

    const modal1 = document.getElementById('modal1');
    const closeModal1 = modal1.querySelector('.cierra');
    const confirmPasswordBtn1 = document.getElementById('confirm-password1');

    const modal2 = document.getElementById('modal2');
    const closeModal2 = modal2.querySelector('.cierra');
    const confirmPasswordBtn2 = document.getElementById('confirm-password2');
    const cancelButton2 = document.getElementById('cancel-button2');

    let currentInput;

    inputs.forEach(input => {
        input.addEventListener('click', (event) => {
            event.stopPropagation();  // Prevenir burbujeo
            currentInput = input;
            modal1.style.display = 'flex';
        });
    });

    botonCuenta.addEventListener('click', (event) => {
        event.stopPropagation();  // Prevenir burbujeo
        modal2.style.display = 'flex';
    });

    closeModal1.addEventListener('click', () => {
        modal1.style.display = 'none';
    });

    confirmPasswordBtn1.addEventListener('click', () => {
        const currentPassword = document.getElementById('current-password1').value;
        if (currentPassword === "tuContraseñaActual") {
            modal1.style.display = 'none';
            currentInput.focus();
        } else {
            alert('Contraseña incorrecta');
        }
    });

    closeModal2.addEventListener('click', () => {
        modal2.style.display = 'none';
    });

    cancelButton2.addEventListener('click', () => {
        modal2.style.display = 'none';
    });

    confirmPasswordBtn2.addEventListener('click', () => {
        
        
        modal2.style.display = 'none';
    });

    window.addEventListener('click', (event) => {
        if (event.target === modal1) {
            modal1.style.display = 'none';
        }
        if (event.target === modal2) {
            modal2.style.display = 'none';
        }
    });
    
});

