@extends('layouts.base')

@section('title') Profile @php $css = "profilestyle" @endphp @endsection

@section('content')
    @include('components.NavBar.aside')

    <div class="right">
        <div class="card-profile"> 
            <div class="profile-photo">
                <img src="{{ Vite::asset('resources/assets/images/tupi-perfil.jpeg') }}" alt="Foto de Perfil" class="profile-picture">
                <div class="profile-info">
                    <span class="name">Tupac <i class="bi bi-patch-check-fill mora"></i></span>
                </div>
            </div> 
            <div class="container">
                <div class="content">
                    <div class="item1 followers items">
                        <span class="text"><i class="bi bi-person-hearts"></i>Followers</span>
                        <span class="numelo " id="contador">0</span>
                    </div>

                    <div class="item3 post-index items">
                        @include('components.posts.post', [
                            'UserPhoto' => Vite::asset('resources/assets/images/foto-tipo-landing.jpeg'),
                            'UserName' => 'Perfil', 'text' => 'Lorem ipsim acqu a] fjsibfhrmmmau marina dbo nskxicnrem.sc',
                            'SongName' => 'Nombre', 'SongPhoto' => Vite::asset('resources/assets/images/foto-thor-landing.jpeg'),
                            'bpm' => '136', 'song' => Vite::asset('resources/assets/audios/Shook Ones, Pt  II (Instrumental).mp3'),
                            'price' => '0.00', 'AuthorName' => 'Author', 'scale' => 'C Major', 'duration' => '3:00'
                        ])
                    </div>

                    <div class="item2 followed items">
                        <span class="text"><i class="bi bi-person-check-fill"></i>Followed</span>
                        <span class="numelo" id="contadorfollow">0</span>
                    </div>
                    
                    <div class="item4 playlist items">
                        <span class="text-spe"> <i class="bi bi-music-note-list no"></i>Playlists</span>
                        <div class="players">
                            @include('components.profile.playlist', [
                                'photo' => Vite::asset('resources/assets/images/playlist1.jpeg'),
                                'name' => 'Trippy triple shot', 'description' => 'reggae,rock, funk'
                            ])
                        </div>
                    </div>
                    <div class="item5 reviews items">
                        <span class="text-spe" id = "x"><i class="bi bi-chat-square-heart-fill"></i>Reviews</span>
                        <div class="content-reviews">
                            @include('components.profile.review', [
                                'photo' => Vite::asset('resources/assets/images/tipq2.jpeg'),
                                'FromName' => 'Jeremy osborn', 'title' => 'i really enjoy your style of rap'
                            ])
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('components.buttons.NewPost')
    </div>

    <div id="overlay"></div>
    @include('components.posts.NewPost')
    @include('components.profile.followers', [
       'followers' => [
            [Vite::asset('resources/assets/images/perfil2.jpeg'), 'Juan'],
            [Vite::asset('resources/assets/images/perfil2.jpeg'), 'Pepe'],
       ]
    ])
    @include('components.profile.followed', [
        'followers' => [
            [Vite::asset('resources/assets/images/perfil2.jpeg'), 'Juan'],
            [Vite::asset('resources/assets/images/perfil2.jpeg'), 'Pepe'],
        ]
    ])

    <script src="{{ Vite::asset('resources/js/profilescript.js') }}" ></script>
@endsection