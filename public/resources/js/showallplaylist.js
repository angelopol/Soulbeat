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