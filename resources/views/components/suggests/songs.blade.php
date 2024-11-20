<div class="cardesoul">
    <img class="fotosoul" src="{{ $photo }}" alt="">
    <div id="fle">
        <div class="prezio"><span class="prezio currency" SymbolId="{{$id}}SymbolSong">{{ $price }}</span><span class="symbol prezio" id="{{$id}}SymbolSong">$</span></div>
        <span class="bi bi-play-fill whi" data-audio-src="{{ $song }}"></span>
    </div>
    <button class="buynow">BUY NOW</button>
</div>