
document.addEventListener('DOMContentLoaded', () => {
    console.log("Documento cargado");

    // Manejar botones de reproducción y pausa
    document.querySelectorAll('.bi-play-fill, .bi-pause-fill').forEach(button => {
        button.addEventListener('click', function () {
            const audioSrc = this.getAttribute('data-audio-src');
            let audio = this.nextElementSibling;

            if (!audio) {
                audio = new Audio(audioSrc);
                this.insertAdjacentElement('afterend', audio);
            }

            // Pausar otros audios
            document.querySelectorAll('.bi-pause-fill').forEach(pauseButton => {
                let otherAudio = pauseButton.nextElementSibling;
                if (otherAudio && otherAudio !== audio) {
                    otherAudio.pause();
                    pauseButton.classList.remove('bi-pause-fill');
                    pauseButton.classList.add('bi-play-fill');
                }
            });

            // Reproducir o pausar el audio
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

            // Manejar la barra de progreso
            const progressBar = this.closest('.fotoplay').nextElementSibling.querySelector('.barra-progreso');
            audio.addEventListener('timeupdate', () => {
                const progress = (audio.currentTime / audio.duration) * 100;
                progressBar.value = progress;
                progressBar.style.setProperty('--progress', `${progress}%`);
            });

            progressBar.addEventListener('input', (event) => {
                const value = event.target.value;
                audio.currentTime = (value / 100) * audio.duration;
                progressBar.style.setProperty('--progress', `${value}%`);
            });
        });
    });

    // Manejar botón de editar y mostrar botones de eliminar
    const editButton = document.querySelector('.bi-pencil');
    if (editButton) {
        console.log('Botón de edición agarro');

        const showSongsSection = document.querySelector('.show-songs');

        editButton.addEventListener('click', () => {
            console.log('Botón de edición clickeado');

            const items = showSongsSection.querySelectorAll('.itemdecanciones');
            items.forEach(item => {
                let deleteButton = item.querySelector('.delete-btn');

               
                if (deleteButton) {
                    console.log('Alternando a ver el botón de eliminación');
                    deleteButton.style.display = (deleteButton.style.display === 'none') ? 'block' : 'none';

                    // Agregar evento de eliminación
                    deleteButton.addEventListener('click', (event) => {
                        event.stopPropagation(); // Evitar que el clic se propague a otros elementos
                        console.log('Eliminando item...', item); //verificar si sirve el evento
                        item.remove(); // Elimino el item 
                    });
                } else {
                    console.log('No llego aqui');
                }
            });
        });
    } else {
        console.error('El botón .bi-pencil no se encontró en el DOM.');
    }
});

