@extends('layouts.base')

@section('title') Profile @php $css = "profilestyle" @endphp @endsection

@section('content')
    @include('components.NavBar.aside')

    <div class="right">
        <div class="card-profile">
       
        <img src="{{ Vite::asset('resources/assets/images/tupi-perfil.jpeg') }}" alt="Foto de Perfil" class="profile-picture">
        <div class="profile-info">
           
            <span class="name">Tupac <i class="bi bi-patch-check-fill mora"></i></span>
            
        </div>
        <div class="content">
            <div class="item1 followers items">
                <span class="text"><i class="bi bi-person-hearts"></i>followers</span>
                <span class="numelo " id="contador">0</span>
            </div>
            <div class="item3 post-index items">
                <div class="content-all">
                    <div class="post" id="postcompleto">
                        <div class="content-row">
                            <img src="{{ Vite::asset('resources/assets/images/foto-tipo-landing.jpeg') }}" alt="" class="fotobeat">
                            <span class="text-box-post">Perfil  <i class="bi bi-patch-check-fill check"></i></span>
                        </div>
                        <div class="textofpost">
                            <span class="text2">Lorem ipsim acqu a] fjsibfhrmmmau marina dbo nskxicnrem.sc</span>
                        </div>
                        <figure class="card">
                            <span class="name">Nombre</span>
                            <img class="fotoritmo" src="{{ Vite::asset('resources/assets/images/foto-thor-landing.jpeg') }}" alt="">
                            <div class="content-bar">
                                <div id="inicio">0:00</div>
                                <input type="range" id="progress-bar" min="0" max="100" value="0">
                                <div id="final">0:00</div>
                            </div>
                            <div class="info">
                            <span class="bpm">136 bpm</span>
                            <span class="bi bi-play-fill play" data-audio-src = "{{ Vite::asset('resources/assets/audios/Shook Ones, Pt  II (Instrumental).mp3') }}"></span>
                            <div><span class="precio">0.00</span> <span class="symbol precio">$</span></div>
                            </div>
                            <div class="content-botons">
                            <button class="boton-options" id="checkear"><strong class="centri">Comprar</strong></button>
                            <button class="boton-options"><strong class="centri">Descargar </strong></button>
                            <button class="boton-options" id="modal"><strong class="centri">feature modal</strong></button>
                            </div>
                        </figure>
                        
                    </div>
                </div>
                <div class="content-all">
                    <div class="post" id="postcompleto">
                        <div class="content-row">
                            <img src="{{ Vite::asset('resources/assets/images/foto-tipo-landing.jpeg') }}" alt="" class="fotobeat">
                            <span class="text-box-post">Perfil  <i class="bi bi-patch-check-fill check"></i></span>
                        </div>
                        <div class="textofpost">
                            <span class="text2">Lorem ipsim acqu a] fjsibfhrmmmau marina dbo nskxicnrem.sc</span>
                        </div>
                        <figure class="card">
                            <span class="name">Nombre</span>
                            <img class="fotoritmo" src="{{ Vite::asset('resources/assets/images/foto-thor-landing.jpeg') }}" alt="">
                            <div class="content-bar">
                                <div id="inicio">0:00</div>
                                <input type="range" id="progress-bar" min="0" max="100" value="0">
                                <div id="final">0:00</div>
                            </div>
                            <div class="info">
                            <span class="bpm">136 bpm</span>
                            <span class="bi bi-play-fill play" data-audio-src = "{{ Vite::asset('resources/assets/audios/Shook Ones, Pt  II (Instrumental).mp3') }}"></span>
                            <div><span class="precio">0.00</span> <span class="symbol precio">$</span></div>
                            </div>
                            <div class="content-botons">
                            <button class="boton-options" id="checkear"><strong class="centri">Comprar</strong></button>
                            <button class="boton-options"><strong class="centri">Descargar </strong></button>
                            <button class="boton-options" id="modal"><strong class="centri">feature modal</strong></button>
                            </div>
                        </figure>
                        
                    </div>
                </div>
                
        
            </div>

            <div class="item2 followed items">
                <span class="text"><i class="bi bi-person-check-fill"></i>Followed</span>
                <span class="numelo" id="contadorfollow">0</span>
            </div>
            
            <div class="item4 playlist items">
                <span class="text-spe"> <i class="bi bi-music-note-list no"></i>Playlists</span>
                <div class="players">
                    <div class="element">
                        <img class="img" src="{{ Vite::asset('resources/assets/images/playlist1.jpeg') }}" alt="" class="foto-playlist">
                        <div class="content-info-play">
                        <span class="name-play">Trippy triple shot</span>
                        <span class="descri">reggae,rock, <br>funk</span>
                        </div>
                    </div>
                    <div class="element">
                        <img class="img" src="{{ Vite::asset('resources/assets/images/playlis2.jpeg') }}" alt="" class="foto-playlist">
                        <div class="content-info-play">
                        <span class="name-play">Heartbreak</span>
                        <span class="descri">pop,rap, hip-hop</span>
                        </div>
                    </div>
                    <div class="element">
                        <img class="img" src="{{ Vite::asset('resources/assets/images/playlis3.jpg') }}" alt="" class="foto-playlist">
                        <div class="content-info-play">
                        <span class="name-play">Override</span>
                        <span class="descri">reggaeton, pop,jazz</span>
                        </div>
                    </div>
                    <div class="element">
                        <img class="img" src="{{ Vite::asset('resources/assets/images/playlis4.jpeg') }}" alt="" class="foto-playlist">
                        <div class="content-info-play">
                        <span class="name-play">First and Last time</span>
                        <span class="descri">heavy-metal, rock</span>
                        </div>
                    </div>
                </div></div>
            <div class="item5 reviews items">
                <span class="text-spe" id = "x"><i class="bi bi-chat-square-heart-fill"></i>Reviews</span>
                <div class="content-reviews">
                    <div class="part">
                        <img class="image" src="{{ Vite::asset('resources/assets/images/tipa1.jpg') }}" alt="" class="persona">
                        <div class="otra">
                        <span class="name-play">Samantha nakovic</span>
                        <span class="review">OMG your music is so great!</span>
                        </div>
                    </div>
                    <div class="part">
                        <img  class="image" src="{{ Vite::asset('resources/assets/images/tipq2.jpeg') }}" alt="" class="persona">
                        <div class="otra">
                        <span class="name-play">Jeremy osborn</span>
                        <span class="review">i really enjoy your style of rap</span>
                        </div>
                    </div>
                    <div class="part">
                        <img  class="image"src="{{ Vite::asset('resources/assets/images/tipo3.jpg') }}" alt="" class="persona">
                        <div class="otra">
                        <span class="name-play">Sony gomez</span>
                        <span class="review">i wanna make a feat with you man</span>
                        </div>
                    </div>
                    <div class="part">
                        <img class="image" src="{{ Vite::asset('resources/assets/images/tipa4.jpg') }}" alt="" class="persona">
                        <div class="otra">
                        <span class="name-play">michigan bricks</span>
                        <span class="review">i love you Tupac</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        
    </div>
    <script src="{{ Vite::asset('resources/js/profilescript.js') }}" ></script>
@endsection