
function toggleCard(arrow) {
    const card = arrow.closest('.card');
    const content = card.querySelector('.content-tarjet');
    
    if (content.style.maxHeight === "0px" || !content.style.maxHeight) {
        content.style.maxHeight = "32vh"; // Ajusta este valor según el contenido
        arrow.classList.add('down');
    } else {
        content.style.maxHeight = "0px";
        arrow.classList.remove('down');
    }
};const container = document.getElementById('container');
const divlicencias = document.getElementById('cambiable');
const divpaidmethos = document.getElementById('divdepaid');
const divcompanyusers = document.getElementById('divdecomuser');
const divguides = document.getElementById('divguides');
const divqa = document.getElementById('divdeqa');
const licencias = document.getElementById('element0');
const paidmethods = document.getElementById('element1');
const companyusers = document.getElementById('element2');
const guides = document.getElementById('element3');
const qa = document.getElementById('element4');

const elements = [
    { button: licencias, div: divlicencias },
    { button: paidmethods, div: divpaidmethos },
    { button: companyusers, div: divcompanyusers },
    { button: guides, div: divguides },
    { button: qa, div: divqa },
];

function ChangePage(elements, el) {
    elements.forEach(e => {
        if (e === el) {
            e.div.style.display = 'flex';
            container.style.height = 'fit-content'; // Ajusta al contenido
            e.button.style.color = 'white';
        } else {
            e.div.style.display = 'none';
            e.button.style.color = 'dimgray';
        }
    });
}

elements.forEach(el => {
    el.button.addEventListener('click', () => {
        ChangePage(elements, el);
    });
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

ChangePage(elements, elements[0]);