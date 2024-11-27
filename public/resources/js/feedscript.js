const seguido = document.querySelectorAll('.botonseguir');

seguido.forEach((element) => {
    element.addEventListener('click', () => {
        let UserName = this.getAttribute('UserName');
        fetch("/user/followeds/update/"+UserName, {
            method: "POST",
            headers: {
                "Content-type": "application/json; charset=UTF-8"
            }
        });
        if (element.innerHTML === "Follow") {
            element.style.backgroundColor = '#1b1b1b';
            element.style.color = 'rgb(161,0,161)';
            element.innerHTML = "Unfollow";
        } else {
            element.style.backgroundColor = '';
            element.style.color = '';
            element.innerHTML = "Follow";
        }
    });
});