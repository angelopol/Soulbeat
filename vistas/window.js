
const menu = document.querySelector('.menuhamburguesa');

const saliente1 = document.querySelector('.sign');
const saliente2 = document.querySelector('.log');
const saliente3 = document.querySelector('.inte');
console.log(saliente1, saliente2, menu)


menu.addEventListener('click', () => {
    saliente1.classList.toggle('active');
    saliente2.classList.toggle('active');
    saliente3.classList.toggle('active');
})
const todosnegro = document.querySelectorAll('.cambio');
const logo = document.getElementById('logopapa');
const texto = document.getElementById('swiche');
const cheki = document.getElementById('check');

function verificado() {

    if (cheki.checked) {
        texto.innerHTML = 'Dark Mode';
        todosnegro.forEach((element) => {
            element.style.backgroundColor = 'black';
            element.style.color = 'white';
        })
        invertColors();
    } else {
        productUsual();
        texto.innerHTML = 'Light Mode';
        todosnegro.forEach((element) => {
            element.style.backgroundColor = 'white';
            element.style.color = 'black';
    })
    
}

change();
}

function invertColors() {
    const svg = document.getElementById('logopapa');
    const footer = document.getElementById('logofooter');
const svgpanel = document.getElementById('logoani');
const elements = svg.querySelectorAll('*');
const elements2 = footer.querySelectorAll('*');
const cambiopanel = svgpanel.querySelectorAll('*');

elements.forEach((element) => {
    const fill = window.getComputedStyle(element).fill;

    if (fill === 'rgb(255, 255, 255)') { // Blanco
        element.setAttribute('fill', 'black');
    } else if (fill === 'rgb(0, 0, 0)') { // Negro
        element.setAttribute('fill', 'white');
    }
});

cambiopanel.forEach((element0) => {
    const fill = window.getComputedStyle(element0).fill;

    if (fill === 'rgb(0, 0, 0)') { // Negro
        element0.setAttribute('fill', 'white');
    } else if (fill === 'rgb(255, 255, 255)') { // Blanco
        element0.setAttribute('fill', 'black');
    }
});

elements2.forEach((element) => {
    const fill = window.getComputedStyle(element).fill;

    if (fill === 'rgb(255, 255, 255)') { // Blanco
        element.setAttribute('fill', 'black');
    } else if (fill === 'rgb(0, 0, 0)') { // Negro
        element.setAttribute('fill', 'white');
    }
});
}

function productUsual() {

    const footer = document.getElementById('logofooter');
    const elements2 = footer.querySelectorAll('*');
    const svg = document.getElementById('logopapa');
    const svgpanel = document.getElementById('logoani');
    const elements = svg.querySelectorAll('*');
    const cambiopanel = svgpanel.querySelectorAll('*');

    elements.forEach((element) => {
        const fill = window.getComputedStyle(element).fill;
        const stroke = window.getComputedStyle(element).stroke;

        if (fill === 'rgb(255, 255, 255)') { // Blanco
            element.setAttribute('fill', 'black');
        } else if (fill === 'rgb(0, 0, 0)') { // Negro
            element.setAttribute('fill', 'black');
        }

    });

cambiopanel.forEach((element0) => {
        const fill = window.getComputedStyle(element0).fill;
        console.log(`Elemento: ${element0.tagName}, Fill: ${fill}`);

        if (fill === 'rgb(255, 255, 255)') { // Blanco
            element0.setAttribute('fill', 'black');
        } else if (fill === 'rgb(0, 0, 0)') { // Negro
            element0.setAttribute('fill', 'black');
        }
    });

    elements2.forEach((element0) => {
        const fill = window.getComputedStyle(element0).fill;
        console.log(`Elemento: ${element0.tagName}, Fill: ${fill}`);

        if (fill === 'rgb(255, 255, 255)') { // Blanco
            element0.setAttribute('fill', 'black');
        } else if (fill === 'rgb(0, 0, 0)') { // Negro
            element0.setAttribute('fill', 'black');
        }
    });
  

    
}


function change() {

    const change = document.getElementById('cen');
    const cheki = document.getElementById('check');
    const cartas = document.getElementById('carta');
    const carta2 = document.getElementById('carta2');
    const carta3 = document.getElementById('carta3');
    const letrasdecarta = document.querySelectorAll('.car')
    if (cheki.checked) {
        change.style.backgroundColor = 'white';
        change.style.color = 'white';
        cartas.style.backgroundColor = 'white';
        cartas.style.setProperty('--before-bg-color', '#303030');
        carta2.style.backgroundColor = 'white';
        carta2.style.setProperty('--before-bg-color', '#303030');
        carta3.style.backgroundColor = 'white';
        carta3.style.setProperty('--before-bg-color', '#303030');
        letrasdecarta.forEach((element) => {
            element.style.color = 'white'
        })
        
    }
    else{
        change.style.backgroundColor = 'black';
        change.style.color = 'white'
        cartas.style.backgroundColor = 'white';
        letrasdecarta.style.color = 'white';
    }
}

function changetext(){
    const cheki = document.getElementById('check');
    
}


document.querySelectorAll('.bi-play-fill, .bi-pause-fill').forEach(button => {
    button.addEventListener('click', function() {
        const audioSrc = this.getAttribute('data-audio-src');
        let audio = this.querySelector('audio');
        
        if (!audio) {
            audio = new Audio(audioSrc);
            this.appendChild(audio);
        }

        
        document.querySelectorAll('.bi-pause-fill').forEach(pauseButton => {
            let otherAudio = pauseButton.querySelector('audio');
            if (otherAudio && otherAudio !== audio) {
                otherAudio.pause();
                pauseButton.classList.remove('bi-pause-fill');
                pauseButton.classList.add('bi-play-fill');
            }
        });

      
        if (audio.paused) {
            audio.play().then(() => {
                this.classList.remove('bi-play-fill');
                this.classList.add('bi-pause-fill');
            }).catch(error => {
                console.error('Error playing audio:', error);
            });
        } else {
            audio.pause();
            this.classList.remove('bi-pause-fill');
            this.classList.add('bi-play-fill');
        }
    });
});

