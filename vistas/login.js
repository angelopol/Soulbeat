const cambio = document.getElementById('cambio');
const login = document.querySelector('.login');
const signin = document.querySelector('.signin');
const regreso = document.getElementById('regreso');
const forgot = document.getElementById('forgot');
const password = document.querySelector('.forg');
const flechi = document.querySelector('.flechi');

signin.style.display = 'none';

cambio.addEventListener('click', ()=>{
    login.style.display = 'none';
    signin.style.display = 'flex';
});

regreso.addEventListener('click', ()=>{
    signin.style.display = 'none';
    login.style.display = 'flex';
})

forgot.addEventListener('click', ()=>{
    signin.style.display = 'none';
    login.style.display = 'none';
    password.style.display= 'flex';

});

flechi.addEventListener('click', ()=> {
    password.style.display = 'none';
    login.style.display = 'flex';
    signin.style.display = 'none';
})


document.querySelector('.bi-pencil').addEventListener(()=>{
    
})