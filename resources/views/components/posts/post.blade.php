<div class="post" id="postcompleto">
    <div class="content-row">
        <a href="{{ route('profile.post.view', $UserName) }}" style="all: unset">
            @if($UserPhoto != "/storage/")
                <img src="{{ $UserPhoto }}" alt="" class="fotobeat">
            @endif
            <span class="text-box-post">{{ $UserName }}
                @if(isset($verify) && $verify)<i class="bi bi-patch-check-fill check"></i>@endif
            </span>
        </a>
        @if(auth()->user()->id == $UserId)
            <div>
                <span class="bi bi-three-dots">
                    <ul class="dropdown">
                        <li>
                            <form action="{{ route('post.archive', $id) }}" method="POST">
                                @csrf
                                <button type="submit" style="all: unset">Archive</button>
                            </form>
                        </li>
                        <li>
                            <form action="{{ route('post.destroy', $id) }}" method="POST">
                                @csrf
                                <button type="submit" style="all: unset">Delete</button>
                            </form>
                        </li>
                        <li>
                            <form action="{{ route('post.announce', $id) }}" method="POST">
                                @csrf @method('PATCH')
                                <button type="submit" style="all: unset">Announce</button>
                            </form>
                        </li>
                        <li>Add to playlist</li>
                    </ul>
                </span>
            </div>
        @endif
    </div>
    <div class="textofpost">
        <span class="text2">{{ $text }}</span>
    </div>
    <figure class="card">
        <span class="name">{{ $SongName }}</span>
        <img class="fotoritmo" src="{{ $SongPhoto }}" alt="">
        <div class="content-bar">
            <div class="inicio">0:00</div>
            <input type="range" class="progress-bar" min="0" max="100" value="0">
            <div class="final">0:00</div>
        </div>
        <div class="info">
            <span class="bpm">{{ $bpm }} BPM</span>
            <span class="bi bi-play-fill play" data-audio-src = "{{ $song }}"></span>
            <div>
                <span class="precio currency" SymbolId="{{$id}}SymbolA">{{ $price }}</span> <span class="symbol precio" id="{{$id}}SymbolA">$</span>
            </div>
        </div>
        <div class="content-botons">
            @if($price == 0 || auth()->user()->id == $UserId)
                <form action="{{ route('post.download', $post) }}" method="POST">
                    <button class="boton-options"><strong>Download</strong></button>
                </form>
            @else
                <form action="{{route('chat.store')}}" method="POST" style="all: unset">
                    @csrf
                    <input type="text" name="to" value="{{$UserId}}" hidden>
                    <input type="text" name="type" value="true" hidden>
                    <button class="boton-options" id="checkear"><strong>Buy</strong></button>
                </form>
            @endif
            <button class="boton-options abrirmodal" id="modal" modal="{{$id}}"><strong>Features</strong></button>
        </div>
    </figure>
    <div class="boton-container">
        <button class="boton-reactions">What's up?</button>
        <div class="reactions">
            <span class="reaction" reaction="1" post="{{ $post->id }}">
                <img src="{{ Vite::asset('resources/assets/images/Lapartio.png') }}" alt="">
                <div class="texto-oculto">This is insane!</div>
            </span>
            <span class="reaction" reaction="2" post="{{ $post->id }}">
                <img src="{{ Vite::asset('resources/assets/images/QUEEEE.png') }}" alt="">
                <div class="texto-oculto">Whattt!</div>
            </span>
            <span class="reaction" reaction="3" post="{{ $post->id }}">
                <img src="{{ Vite::asset('resources/assets/images/INCREIBLE!.png') }}" alt="">
                <div class="texto-oculto">Amazinggg</div>
            </span>
            <span class="reaction" reaction="4" post="{{ $post->id }}">
                <img src="{{ Vite::asset('resources/assets/images/regular.png') }}" alt="">
                <div class="texto-oculto">meh</div>
            </span>
            <span class="reaction" reaction="5" post="{{ $post->id }}">
                <img src="{{ Vite::asset('resources/assets/images/algomejor.png') }}" alt="">
                <div class="texto-oculto">i hope for something better</div>
            </span>
        </div>
    </div>
</div>

@include('components.posts.features', [
    'duration' => $duration, 'AuthorName' => $AuthorName, 'bpm' => $bpm, 'scale' => $scale, 'price' => $price, 'id' => $id,
    'UserId' => $UserId
])