<div class="anuncio">
    <nav>
        <div class="post">
            <img class="foto" src="{{ $photo }}" alt="">
            <span class="nombredelbeat">{{ $title }}</span>
        </div>
    </nav>
    <nav>
        <span class="price currency" SymbolId="{{$ad->id}}SymbolAd">{{ $cost }}</span><span id="{{$ad->id}}SymbolAd">$</span>
    </nav>
    <nav>
        <span class="time">{{ $EndTime }}<span>
    </nav>
    <button class="delete-btn" style="display: none;">&#x2212;</button>
</div>