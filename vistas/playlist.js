document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.bi-play-fill, .bi-pause-fill').forEach(button => {
        button.addEventListener('click', function() {
            const audioSrc = this.getAttribute('data-audio-src');
            let audio = this.nextElementSibling;

            if (!audio) {
                audio = new Audio(audioSrc);
                this.insertAdjacentElement('afterend', audio);
            }

            document.querySelectorAll('.bi-pause-fill').forEach(pauseButton => {
                let otherAudio = pauseButton.nextElementSibling;
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
                }).catch(error => {
                    console.error('Error playing audio:', error);
                });
            } else {
                audio.pause();
                this.classList.remove('bi-pause-fill');
                this.classList.add('bi-play-fill');
            }

            const progressBar = this.closest('.fotoplay').nextElementSibling.querySelector('.barra-progreso');
            //para que agarre auno solo independiente 
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
});

function formatTime(seconds) {
    const minutes = Math.floor(seconds / 60);
    const secs = Math.floor(seconds % 60);
    return `${minutes}:${secs < 10 ? '0' : ''}${secs}`;
}
