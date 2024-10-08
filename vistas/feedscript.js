const botontocado = document.getElementById('modal');

const modal = document.getElementById('ventana');
const cerrar = document.querySelector('.cerrar')
const metodos = document.querySelectorAll('.pays')

botontocado.addEventListener('click', () =>{
    ventana.style.display = 'block';
    document.getElementById('overlay').style.display = 'block';

})

cerrar.addEventListener('click',()=>{
    document.getElementById('overlay').style.display = 'none';
    modal.style.display='none';

})
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.bi-play-fill, .bi-pause-fill').forEach(button => {
      button.addEventListener('click', function() {
        const audioSrc = this.getAttribute('data-audio-src');
        let audio = this.querySelector('audio');
        let interval;
  
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
  
            // Inicia el intervalo para actualizar la barra de progreso
            interval = setInterval(updateProgress, 10);
          }).catch(error => {
            console.error('Error playing audio:', error);
          });
        } else {
          audio.pause();
          clearInterval(interval);
          this.classList.remove('bi-pause-fill');
          this.classList.add('bi-play-fill');
        }
  
        function updateProgress() {
          if (!audio.paused) {
            const progress = (audio.currentTime / audio.duration) * 100;
            const progressBar = document.getElementById('progress-bar');
            progressBar.value = progress;
            progressBar.style.setProperty('--progress', `${progress}%`);
  
           
            document.getElementById('inicio').textContent = formatTime(audio.currentTime);
            document.getElementById('final').textContent = formatTime(audio.duration);
          } else {
            clearInterval(interval);
          }
        }
  
        document.getElementById('progress-bar').addEventListener('input', (event) => {
          const value = event.target.value;
          audio.currentTime = (value / 100) * audio.duration;
          document.getElementById('progress-bar').style.setProperty('--progress', `${value}%`);
        });
      });
    });
  });
  
  function formatTime(seconds) {
    const minutes = Math.floor(seconds / 60);
    const secs = Math.floor(seconds % 60);
    return `${minutes}:${secs < 10 ? '0' : ''}${secs}`;
  }
  
  
  

const down = document.getElementById('content');
const drop = document.getElementById('drop');

var dropdownItems = document.querySelectorAll('.dropdown-content a');


dropdownItems.forEach(function(item) {
  item.addEventListener('click', function(event) {
    event.preventDefault();


    
    var symbol = event.target.getAttribute('data-symbol');

   
    var symbols = document.querySelectorAll('.symbol');
 
    symbols.forEach(function(elem) {
      elem.textContent = symbol;
    });

   
    document.querySelector('.dropbtn').textContent = "Moneda: " + symbol;
  });
});

const seguido = document.querySelectorAll('.botonseguir');

seguido.forEach((element) => {
  element.addEventListener('click', () => {
    if (element.innerHTML === "Seguir") {
      element.style.backgroundColor = '#1b1b1b';
      element.style.color = 'rgb(161,0,161)';
      element.innerHTML = "Siguiendo";
    } else {
      element.style.backgroundColor = '';
      element.style.color = '';
      element.innerHTML = "Seguir";
    }
  });
});
