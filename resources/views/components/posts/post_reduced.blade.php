<div class="itemdecanciones">
    <div class="fotoplay">
        <img src="{{ $photo }}" alt="" class="imagenbeat">
        <i class="bi bi-play-fill pla" data-audio-src="{{ $song }}" ></i>
    </div>
    <div class="detalles">
        
        <nav class="infos">  
            <span class="namebeat">{{ $name }}</span>
            <button class="interactions-songs">Reaction</button>
            <button class="interactions-songs">Buy</button>
            <button class="interactions-songs">Download</button>
            <button class="interactions-songs">Features</button>
            <button class="delete-btn" style="display: none;">&#x2212;</button>
        </nav>   
        <nav class="barradesong">
            <input type="range" id="progress-bar" min="0" max="100" value="0"class="barra-progreso">
        </nav>
       
    </div>
</div>