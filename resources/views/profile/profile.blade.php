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

                    <div class="item3 post-index items" id="posts">
                        @php $PostsIds = ''; @endphp
                        @forelse ($posts as $post)
                            @include('components.posts.post', [
                                'UserPhoto' => Storage::url($post->UserPhoto), 'id' => $post->id, 'UserId' => $post->user,
                                'UserName' => $post->UserName, 'text' => $post->body, 'verify' => $post->subscribed == 1,
                                'SongName' => $post->title, 'SongPhoto' => Storage::url($post->photo),
                                'bpm' => $post->bpm, 'song' => Storage::url($post->song),
                                'price' => $post->cost, 'AuthorName' => $post->PersonName.' '.$post->PersonFullName, 'scale' => $post->scale, 'duration' => '3:00'
                            ])
                            @php $PostsIds .= $post->id.','; @endphp
                        @empty
                            <span class="text">No posts yet</span>
                        @endforelse
                        <span id="PostsCount" hidden>{{ $PostsIds }}</span>
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

    <script src="{{ Vite::asset('resources/js/profilescript.js') }}" defer></script>
    <script src="{{ Vite::asset('resources/js/CreatePost.js') }}" defer></script>
    <script src="{{ Vite::asset('resources/js/NewPosts.js') }}"></script>
@endsection