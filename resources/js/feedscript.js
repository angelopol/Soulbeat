const botontocado = document.querySelectorAll('.abrirmodal');
const modals = document.querySelectorAll('.container-modal');
const cerrarbuttons = document.querySelectorAll('.cerrar');
const metodos = document.querySelectorAll('.pays');

const newpost = document.querySelector('.new-postss');
const modalpost = document.querySelector('.cofnew');


botontocado.forEach(button => {
    button.addEventListener('click', () => {
        const modalId = button.getAttribute('modal');
        const targetModal = document.getElementById(modalId);
        if (targetModal) {
            targetModal.style.display = 'block';
            document.getElementById('overlay').style.display = 'block';
        }
    });
});


cerrarbuttons.forEach(cerrar => {
    cerrar.addEventListener('click',()=>{
        document.getElementById('overlay').style.display = 'none';
        modals.forEach(modal => {
            modal.style.display='none';
        });
    });
});


function openModal() {
  document.getElementById('blacki').style.display = 'block';
  document.querySelector('.cofnew').style.display = 'block';
}


function closeModal() {
  document.getElementById('blacki').style.display = 'none';
  document.querySelector('.cofnew').style.display = 'none';
}


document.querySelector('.chao').addEventListener('click', closeModal);

document.querySelector('.new-post').addEventListener('click', openModal);
document.querySelector('.new-post').addEventListener('click', (event) => {
    event.stopPropagation();
    openModal();
});
document.querySelectorAll('.new-post *').forEach(child => {
    child.addEventListener('click', (event) => {
        event.stopPropagation();
        openModal();
    });
});

document.getElementById('blacki').addEventListener('click', closeModal);



document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('.bi-play-fill').forEach(button => {
      button.addEventListener('click', function() {
          const audioSrc = this.getAttribute('data-audio-src');
          let audio = this.querySelector('audio');
          let interval;

          if (!audio) {
              audio = new Audio(audioSrc);
              this.appendChild(audio);
          }

          // Detener otros audios y actualizar botones
          document.querySelectorAll('.bi-pause-fill').forEach(pauseButton => {
              let otherAudio = pauseButton.querySelector('audio');
              if (otherAudio && otherAudio !== audio) {
                  otherAudio.pause();
                  pauseButton.classList.remove('bi-pause-fill');
                  pauseButton.classList.add('bi-play-fill');
                  clearInterval(pauseButton.getAttribute('data-interval-id'));
              }
          });

          if (audio.paused) {
              audio.play().then(() => {
                  console.log('Audio is now playing');
                  this.classList.remove('bi-play-fill');
                  this.classList.add('bi-pause-fill');

                  interval = setInterval(() => {
                      console.log('Updating progress...');
                      updateProgress.call(this);
                  }, 100);
                  this.setAttribute('data-interval-id', interval);
              }).catch(error => {
                  console.error('Error playing audio:', error);
              });
          } else {
              audio.pause();
              clearInterval(interval);
              this.classList.remove('bi-pause-fill');
              this.classList.add('bi-play-fill');
          }

          const updateProgress = () => {
              if (!audio.paused) {
                  const contentBar = this.closest('.card').querySelector('.content-bar');
                  const inicio = contentBar.querySelector('.inicio');
                  const final = contentBar.querySelector('.final');
                  const progressBar = contentBar.querySelector('.progress-bar');

                 

                  if (progressBar && inicio && final) {
                      const progress = (audio.currentTime / audio.duration) * 100;
                      progressBar.value = progress;
                      progressBar.style.setProperty('--progress', `${progress}%`);

                      // Actualiza los tiempos
                      inicio.textContent = formatTime(audio.currentTime);
                      final.textContent = formatTime(audio.duration);
                  }
              } else {
                  clearInterval(interval);
              }
          };

          const progressBar = this.closest('.card').querySelector('.progress-bar');
          if (progressBar) {
              progressBar.addEventListener('input', (event) => {
                  const value = event.target.value;
                  audio.currentTime = (value / 100) * audio.duration;
                  progressBar.style.setProperty('--progress', `${value}%`);
              });
          }
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


document.querySelectorAll('.bi').forEach(function(element) {
  element.addEventListener('click', function(event) {
      var dropdown = this.querySelector('.dropdown');
      if (dropdown) {
          if (dropdown.style.display === 'none' || dropdown.style.display === '') {
              dropdown.style.display = 'block';
          } else {
              dropdown.style.display = 'none';
          }
      }
      event.stopPropagation();
  });
});

// Opción: Hacer clic fuera para cerrar todos los dropdowns
document.addEventListener('click', function() {
  document.querySelectorAll('.dropdown').forEach(function(dropdown) {
      dropdown.style.display = 'none';
  });
});


const botonReactions = document.querySelectorAll('.boton-reactions');
const reactionsContainers = document.querySelectorAll('.reactions');

// Hide all reactions containers by default
reactionsContainers.forEach((container) => {
    container.style.display = 'none';
});

botonReactions.forEach((button, index) => {
    button.addEventListener('mouseenter', () => {
        reactionsContainers[index].style.display = 'inline-flex';
    });

    button.addEventListener('mouseleave', () => {
        if (!reactionsContainers[index].matches(':hover')) {
            reactionsContainers[index].style.display = 'none';
        }
    });
});

reactionsContainers.forEach((container) => {
    container.addEventListener('mouseleave', () => {
        container.style.display = 'none';
    });

    container.addEventListener('mouseenter', () => {
        container.style.display = 'flex';
    });
});





document.getElementById('imageInput').addEventListener('change', function(event) {
  const file = event.target.files[0];
  const preview = document.getElementById('imagePreview');

  if (file) {
      const reader = new FileReader();
      
      reader.onload = function(e) {
          // Limpiar el contenido previo
          preview.innerHTML = '';
          // Crear una nueva imagen
          const img = document.createElement('img');
          img.src = e.target.result; // Establecer la fuente de la imagen
          preview.appendChild(img); // Agregar la imagen al recuadro
      };

      reader.readAsDataURL(file); // Leer la imagen como Data URL
  }
});
