var searching = false;

window.addEventListener('scroll', async () => {
    const postsContainer = document.getElementById('posts');
    if (!postsContainer) return;
    if ((window.innerHeight + window.scrollY) >= (document.documentElement.scrollHeight - 10) && !searching) {
        searching = true;
        
        try {
            const postsCount = document.getElementById('PostsCount').innerText;
            let fetchUrl = '/posts?ids=' + postsCount;

            // Check if the current path starts with /user/
            if (window.location.pathname.startsWith('/user/')) {
                fetchUrl = window.location.pathname + '?ids=' + postsCount;
                console.log('fetchUrl:', fetchUrl);
            }

            const response = await fetch('/posts?ids=' + postsCount);
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            const posts = await response.json();
            
            posts.forEach(async post => {
                const postElement = await PostElement(post);
                if (postElement != null) {
                    document.getElementById('posts').appendChild(postElement);
                    postsContainer.appendChild(postElement);
                    postsContainer.appendChild(features(post));
            
                    // Update PostsCount to include the new post ID
                    document.getElementById('PostsCount').innerText += `,${post.id}`;
                    initializeEventListeners();
                }
            });
        } catch (error) {
            console.error('Error fetching posts:', error);
        } finally {
            searching = false;
        }
    }
});

function features(post) {
    const modalElement = document.createElement('div');
    modalElement.className = 'container-modal';
    modalElement.id = post.id;
    modalElement.innerHTML = `
        <div class="infomodal">
            <span class="duration">Duracion completa: <br> ${post.duration}</span>
            <span class="autor">${post.AuthorName}</span>
            <button class="bi bi-x-lg cerrar"></button>
        </div>
        <div class="methods">
            <div class="pays"><img class="PAYED" src="../../images/binance.png" alt=""></div>
            <div class="pays"><img class="PAYED" src="../../images/paypal.png" alt=""></div>
            <div class="pays"><img class="PAYED" src="../../images/zelle.png" alt=""></div>
            <div class="pays"><img class="PAYED" src="../../images/pagomovil.png" alt=""></div>
            <div class="pays"><img class="PAYED" src="../../images/bitcoin.png" alt=""></div>
        </div>
        <div class="bpms">
            <span class="rit">${post.bpm} BPM</span>
            <span class="note">${post.scale}</span>
        </div>
        <div class="costs">
            <div class="change"><button class="dropbtn" id="drop">Change currency</button>
                <div class="dropdown-content" id="content">
                    <a href="#" class="item" data-symbol="$">Dólares</a>
                    <a href="#" class="item" data-symbol="Bs">Bolívares</a>
                </div>
            </div>
            <div id="inline"><span class="price">${post.cost}</span><span class="symbol price">$</span></div>
        </div>
        <div class="licencias">
            <span class="lic">Licencias: </span>
            <span class="pre">Premiun</span>
        </div>
        ${post.cost == 0 || post.ThisUser == "True" ? `
            <form class="final" action="/posts/download/${post.id}" method="POST">
                <button class="press"><strong>Download</strong></button>
            </form>
        ` : `
            <form class="final" action="/chat/store" method="POST">
                <input type="text" name="to" value="${post.UserId}" hidden>
                <input type="text" name="type" value="true" hidden>
                <button class="press" id="checkear"><strong>Buy</strong></button>
            </form>
        `}
    `;

    return modalElement;
}

async function PostElement(post) {
    var PostData = null;
    try {
        const response = await fetch('/posts/'+post.id);
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        PostData = await response.json();
    } catch (error) {
        console.error('Error fetching posts:', error);
        return null;
    }

    const postElement = document.createElement('div');
    postElement.className = 'post';
    postElement.id = 'postcompleto';
    postElement.innerHTML = `
        <div class="content-row">
            <a href="/user/${post.UserName}" style="all: unset">
                ${post.UserPhoto !== "/storage/" ? `<img src="${post.UserPhoto}" alt="" class="fotobeat">` : ''}
                <span class="text-box-post">${post.UserName}
                    ${post.verify ? '<i class="bi bi-patch-check-fill check"></i>' : ''}
                </span>
            </a>
            ${post.ThisUser == "True" ? `
                <div>
                    <span class="bi bi-three-dots">
                        <ul class="dropdown">
                            <li>
                                <form action="/posts/archive/${post.id}" method="POST">
                                    <button type="submit" style="all: unset">Archive</button>
                                </form>
                            </li>
                            <li>
                                <form action="/posts/destroy/${post.id}" method="POST">
                                    <button type="submit" style="all: unset">Delete</button>
                                </form>
                            </li>
                            <li>
                                <form action="/posts/announce/${post.id}" method="POST">
                                    <button type="submit" style="all: unset">Announce</button>
                                </form>
                            </li>
                            <li>Add to playlist</li>
                        </ul>
                    </span>
                </div>
            ` : ''}
        </div>
        <div class="textofpost">
            <span class="text2">${post.body}</span>
        </div>
        <figure class="card">
            <span class="name">${post.title}</span>
            <img class="fotoritmo" src="${post.SongPhoto}" alt="">
            <div class="content-bar">
                <div class="inicio">0:00</div>
                <input type="range" class="progress-bar" min="0" max="100" value="0">
                <div class="final">0:00</div>
            </div>
            <div class="info">
                <span class="bpm">${post.bpm} BPM</span>
                <span class="bi bi-play-fill play" data-audio-src="${post.song}"></span>
                <div>
                    <span class="precio">${post.cost}</span> <span class="symbol precio">$</span>
                </div>
            </div>
            <div class="content-botons">
                ${post.cost == 0 || post.ThisUser == "True" ? `
                    <form action="/posts/download/${post.id}" method="POST">
                        <button class="boton-options"><strong>Download</strong></button>
                    </form>
                ` : `
                    <form action="/chat/store" method="POST" style="all: unset">
                        <input type="text" name="to" value="${post.UserId}" hidden>
                        <input type="text" name="type" value="true" hidden>
                        <button class="boton-options" id="checkear"><strong>Buy</strong></button>
                    </form>
                `}
                <button class="boton-options abrirmodal" id="modal" modal="${post.id}"><strong>Features</strong></button>
            </div>
        </figure>
        <div class="boton-container">
            <button class="boton-reactions">What's up?</button>
            <div class="reactions">
                <span class="reaction" reaction="1" post="${post.id}">
                    <img src="/resources/assets/images/Lapartio.png" alt="">
                    <div class="texto-oculto">This is insane!</div>
                </span>
                <span class="reaction" reaction="2" post="${post.id}">
                    <img src="/resources/assets/images/QUEEEE.png" alt="">
                    <div class="texto-oculto">Whattt!</div>
                </span>
                <span class="reaction" reaction="3" post="${post.id}">
                    <img src="/resources/assets/images/INCREIBLE!.png" alt="">
                    <div class="texto-oculto">Amazinggg</div>
                </span>
                <span class="reaction" reaction="4" post="${post.id}">
                    <img src="/resources/assets/images/regular.png" alt="">
                    <div class="texto-oculto">meh</div>
                </span>
                <span class="reaction" reaction="5" post="${post.id}">
                    <img src="/resources/assets/images/algomejor.png" alt="">
                    <div class="texto-oculto">i hope for something better</div>
                </span>
            </div>
        </div>
    `;
    return postElement;
}

function initializeEventListeners() {
    const botontocado = document.querySelectorAll('.abrirmodal');
    const modals = document.querySelectorAll('.container-modal');
    const cerrarbuttons = document.querySelectorAll('.cerrar');
    const reactions = document.querySelectorAll('.reaction');

    reactions.forEach(reaction => {
        if (!elementsWithListeners.has(reaction)) {
            reaction.addEventListener('click', () => {
                const postId = reaction.getAttribute('post');
                const reactionId = reaction.getAttribute('reaction');

                fetch("/posts/reaction/"+postId+"/"+reactionId, {
                    method: "POST",
                    headers: {
                      "Content-type": "application/json; charset=UTF-8"
                    }
                });

                let reactionsContainers = document.querySelectorAll('.reactions');
                // Hide all reactions containers by default
                reactionsContainers.forEach((container) => {
                    container.style.display = 'none';
                });
            });
            elementsWithListeners.add(reaction);
        }
    });

    botontocado.forEach(button => {
        if (!elementsWithListeners.has(button)) {
            button.addEventListener('click', () => {
                const modalId = button.getAttribute('modal');
                const targetModal = document.getElementById(modalId);
                if (targetModal) {
                    targetModal.style.display = 'block';
                    document.getElementById('overlay').style.display = 'block';
                }
            });
            elementsWithListeners.add(button);
        }
    });

    cerrarbuttons.forEach(cerrar => {
        if (!elementsWithListeners.has(cerrar)) {
            cerrar.addEventListener('click', () => {
                document.getElementById('overlay').style.display = 'none';
                modals.forEach(modal => {
                    modal.style.display = 'none';
                });
            });
            elementsWithListeners.add(cerrar);
        }
    });

    document.querySelectorAll('.bi-play-fill').forEach(button => {
        if (!elementsWithListeners.has(button)) {
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
                            updateProgress.call(this);
                        }, 100);
                        this.setAttribute('data-interval-id', interval);
                    }).catch(error => {
                        console.error('Error playing audio:', error);
                        this.classList.remove('bi-pause-fill');
                        this.classList.add('bi-play-fill');
                    });
                } else {
                    audio.pause();
                    clearInterval(interval);
                    this.classList.remove('bi-pause-fill');
                    this.classList.add('bi-play-fill');
                }

                const updateProgress = () => {
                    if (!audio.paused) {
                        if (this.closest('.card') != null) {
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
                        }
                    } else {
                        clearInterval(interval);
                    }
                };

                if (this.closest('.card') != null) {
                    const progressBar = this.closest('.card').querySelector('.progress-bar');
                    if (progressBar) {
                        progressBar.addEventListener('input', (event) => {
                            const value = event.target.value;
                            audio.currentTime = (value / 100) * audio.duration;
                            progressBar.style.setProperty('--progress', `${value}%`);
                        });
                    }
                }
            });
            elementsWithListeners.add(button);
        }
    });

    function formatTime(seconds) {
        const minutes = Math.floor(seconds / 60);
        const secs = Math.floor(seconds % 60);
        return `${minutes}:${secs < 10 ? '0' : ''}${secs}`;
    }

    var dropdownItems = document.querySelectorAll('.dropdown-content a');

    dropdownItems.forEach(function(item) {
        if (!elementsWithListeners.has(item)) {
            item.addEventListener('click', async function(event) {
                event.preventDefault();

                let DolarApi = await fetch('https://ve.dolarapi.com/v1/dolares/oficial').then(response => response.json());
                if(DolarApi.promedio != undefined){
                    var symbol = event.target.getAttribute('data-symbol');
                    let PriceId = event.target.getAttribute('PriceId');

                    var symbols = document.getElementById(PriceId+"Symbol");
                    symbols.textContent = symbol;

                    var price = document.getElementById(PriceId+"Price");
                    var current = document.getElementById(PriceId+"Current");

                    if(symbol == "Bs" && current.textContent == "$"){
                        price.textContent = Math.round(DolarApi.promedio * price.textContent);
                        current.textContent = "Bs";
                    }
                    if(symbol == "$" && current.textContent == "Bs"){
                        price.textContent = Math.round(price.textContent / DolarApi.promedio);
                        current.textContent = "$";
                    }
                }
            });
            elementsWithListeners.add(item);
        }
    });

    document.querySelectorAll('.bi').forEach(function(element) {
        if (!elementsWithListeners.has(element)) {
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
            elementsWithListeners.add(element);
        }
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
        if (!elementsWithListeners.has(button)) {
            button.addEventListener('mouseenter', () => {
                reactionsContainers[index].style.display = 'inline-flex';
            });

            button.addEventListener('mouseleave', () => {
                if (!reactionsContainers[index].matches(':hover')) {
                    reactionsContainers[index].style.display = 'none';
                }
            });
            elementsWithListeners.add(button);
        }
    });

    reactionsContainers.forEach((container) => {
        if (!elementsWithListeners.has(container)) {
            container.addEventListener('mouseleave', () => {
                container.style.display = 'none';
            });

            container.addEventListener('mouseenter', () => {
                container.style.display = 'flex';
            });
            elementsWithListeners.add(container);
        }
    });

    const FeaturesModals = document.querySelectorAll('.container-modal');
    FeaturesModals.forEach(modal => {
        if (!elementsWithListeners.has(modal)) {
            if (modal.parentNode) {
                modal.parentNode.removeChild(modal);
            }
            document.body.appendChild(modal);
        }
        elementsWithListeners.add(modal);
    });
}

const elementsWithListeners = new Set();
// Call initializeEventListeners initially to set up event listeners
initializeEventListeners();