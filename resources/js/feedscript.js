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