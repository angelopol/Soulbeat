@extends('layouts.base')

@section('title') Playlists @php $css = "showallplaylist" @endphp @endsection

@section('content')
    @include('components.NavBar.aside')

    <div class="wrapper-of-playlist">
        @include('components.NavBar.profile')
        <nav class="all-playlists">
            <div class="content">
                @include('components.profile.playlist_reduced', [
                    'photo' => Vite::asset('resources/assets/images/playlist1.jpeg'),
                    'name' => 'Trippy triple shot', 'description' => 'reggae,rock, funk'
                ])
            </div>
        </nav>
    </div>

@endsection