@extends('layouts.base')

@section('title') Playlist @php $css = "playlist" @endphp @endsection

@section('content')
    @include('components.NavBar.aside')

    <div class="wrapper-of-playlist">
        <section class="main-playlist">
            <nav class="up-playlist">
                <img class="foto-playlist" src="{{ Vite::asset('resources/assets/images/playlist1.jpeg') }}" alt="">
                <div class="info-playlist">
                <h1 class="title-playlist">Trippy triple shot</h1>
                <span class="caracteristic"> una playlist gustosa</span>
                </div>
            </nav>
        </section>
    
        <section class="show-songs">

            @include('components.posts.post_reduced', [
                'photo' => Vite::asset('resources/assets/images/playlis3.jpg'),
                'name' => 'Trippy triple shot', 'description' => 'reggae,rock, funk',
                'song' => Vite::asset('resources/assets/audios/Shook Ones, Pt  II (Instrumental).mp3')
            ])
            
        </section>
    </div>
 
    <script src="{{ Vite::asset('resources/js/playlist.js') }}"> </script>
@endsection