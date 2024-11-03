const cambio = document.getElementById('cambio');
const login = document.querySelector('.login');
const signin = document.querySelector('.signin');
const regreso = document.getElementById('regreso');
signin.style.display = 'none';

cambio.addEventListener('click', ()=>{
    login.style.display = 'none';
    signin.style.display = 'flex';
});

regreso.addEventListener('click', ()=>{
    signin.style.display = 'none';
    login.style.display = 'flex';
})