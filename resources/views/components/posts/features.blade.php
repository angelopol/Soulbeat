<div class="container-modal" id="{{$id}}">
    <div class="infomodal">
        <span class="duration">Duracion completa: <br> {{ $duration }}</span>
        <span class="autor">{{ $AuthorName }}</span>
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
        <span class="rit">{{$bpm}} BPM</span>
        <span class="note">{{$scale}}</span>
    </div>
    <div class="costs">
        <div class="change"><button class="dropbtn" id="drop">Change currency</button>
            <div class="dropdown-content" id ='content'>
                <a href="#" class="item" data-symbol="$" >Dólares</a>
                <a href="#" class="item" data-symbol="Bs" >Bolívares</a>
            </div>
        </div>
        <div id="inline"><span class="price">{{$price}}</span><span class="symbol price">$</span></div>
    </div>

    <div class="licencias">
        <span class="lic">Licencias: </span>
        <span class="pre">Premiun</span>
    </div>

    @if($price == 0 || auth()->user()->id == $UserId)
        <form class="final" action="{{ route('post.download', $post) }}" method="POST">
            <button class="press"><strong>Download</strong></button>
        </form>
    @else
        <form class="final" action="{{route('chat.store')}}" method="POST">
            @csrf
            <input type="text" name="to" value="{{$UserId}}" hidden>
            <input type="text" name="type" value="true" hidden>
            <button class="press" id="checkear"><strong>Buy</strong></button>
        </form>
    @endif
</div>