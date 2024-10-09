<div class="post" id="postcompleto">
    <div class="content-row">
        <img src="{{ $UserPhoto }}" alt="" class="fotobeat">
        <span class="text-box-post">{{ $UserName }}
            @if(isset($verify))<i class="bi bi-patch-check-fill check"></i>@endif
        </span>
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
            <button class="boton-options" id="modal"><strong>Features</strong></button>
        </div>
    </figure>
</div>

@include('components.posts.features', [
    'duration' => 'Duracion completa', 'AuthorName' => $AuthorName, 'bpm' => $bpm, 'scale' => $scale, 'price' => $price
])