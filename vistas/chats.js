const input = document.querySelector('.typear input');
const messageContainer = document.querySelector('.messagesz');

// Función para enviar el mensaje
function sendMessage() {
    const messageText = input.value;

    if (messageText.trim() !== '') {
        // Crear un nuevo div para el mensaje
        const newMessage = document.createElement('div');
        newMessage.className = 'message rightchat';
        newMessage.innerHTML = `
            <div class="content">
                <div class="textrest">${messageText}</div>
                <div class="time">${new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })}</div>
            </div>
        `;
        messageContainer.appendChild(newMessage);
        input.value = '';

        messageContainer.scrollTop = messageContainer.scrollHeight;
    }
}

// Evento para el botón de enviar
document.querySelector('.send').addEventListener('click', sendMessage);

// Evento para la tecla "Enter"
input.addEventListener('keypress', function(event) {
    if (event.key === 'Enter') {
        sendMessage();
        event.preventDefault(); // Evita el salto de línea
    }
});

const plus = document.querySelector('.m');
const trans = document.querySelector('.trans');
const mes = document.querySelector('.direct');
const nameofstatus = document.querySelector('.nameofstatus');

// Variable para rastrear el estado
let isClicked = false;

trans.addEventListener('click', () => {
    isClicked = !isClicked; // Alterna el estado

    if (isClicked) {
        trans.style.color = 'white';
        mes.style.color = 'dimgray';
       
        nameofstatus.innerHTML = 'Transactions';
    }
});

mes.addEventListener('click', () => {
    isClicked = !isClicked; // Alterna el estado

    if (isClicked) {
        mes.style.color = 'white';
        trans.style.color = 'dimgray';
        
        nameofstatus.innerHTML = 'Direct messages';
    }
});
document.querySelector('.plus').addEventListener('click', function() {
    document.querySelector('.dropdown-content').classList.toggle('show');
});

window.onclick = function(event) {
    if (!event.target.matches('.plus')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        for (var i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
}


