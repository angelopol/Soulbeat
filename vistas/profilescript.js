
document.addEventListener('DOMContentLoaded', () => {
    const contador = document.getElementById('contador');
    let seguidores = 1239;
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
    let seguidores = 384;
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
  
  document.getElementById('blacki').addEventListener('click', closeModal);
  