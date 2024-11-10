
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
  