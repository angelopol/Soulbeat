<div class="post" id="postcompleto">
    <div class="content-row">
        <img src="{{ $UserPhoto }}" alt="" class="fotobeat">
        <span class="text-box-post">{{ $UserName }}
            @if(isset($verify))<i class="bi bi-patch-check-fill check"></i>@endif
        </span>
        <div>
            <span class="bi bi-three-dots">
                <ul class="dropdown">
                    <li>Archive</li>
                    <li>Delete</li>
                    <li>Add to playlist</li>
                </ul>
            </span>
        </div>
    </div>
    <div class="textofpost">
        <span class="text2">{{ $text }}</span>
    </div>
    <figure class="card">
        <span class="name">{{ $SongName }}</span>
        <img class="fotoritmo" src="{{ $SongPhoto }}" alt="">
        <div class="content-bar">
            <div id="inicio">0:00</div>
            <input type="range" id="progress-bar" min="0" max="100" value="0">
            <div id="final">0:00</div>
        </div>
        <div class="info">
            <span class="bpm">{{ $bpm }} BPM</span>
            <span class="bi bi-play-fill play" data-audio-src = "{{ $song }}"></span>
            <div>
                <span class="precio">{{ $price }}</span> <span class="symbol precio">$</span>
            </div>
        </div>
        <div class="content-botons">
            <button class="boton-options" id="checkear"><strong>Buy</strong></button>
            <button class="boton-options"><strong>Download</strong></button>
            <button class="boton-options abrirmodal" id="modal" modal="{{$UserName}}"><strong>Features</strong></button>
        </div>
    </figure>
    <div class="boton-container">
        <button class="boton-reactions">What's up?</button>
        <div class="reactions">
            <span>
                <img src="{{ Vite::asset('resources/assets/images/Lapartio.png') }}" alt="">
                <div class="texto-oculto">This is insane!</div>
            </span>
            <span>
                <img src="{{ Vite::asset('resources/assets/images/QUEEEE.png') }}" alt="">
                <div class="texto-oculto">Whattt!</div>
            </span>
            <span>
                <img src="{{ Vite::asset('resources/assets/images/INCREIBLE!.png') }}" alt="">
                <div class="texto-oculto">Amazinggg</div>
            </span>
            <span>
                <img src="{{ Vite::asset('resources/assets/images/regular.png') }}" alt="">
                <div class="texto-oculto">meh</div>
            </span>
            <span>
                <img src="{{ Vite::asset('resources/assets/images/algomejor.png') }}" alt="">
                <div class="texto-oculto">i hope for something better</div>
            </span>
        </div>
    </div>
</div>

@include('components.posts.features', [
    'duration' => $duration, 'AuthorName' => $AuthorName, 'bpm' => $bpm, 'scale' => $scale, 'price' => $price, 'id' => $UserName
])