@extends('layouts.base')

@section('title') Playlists @php $css = "showallplaylist" @endphp @endsection

@section('content')
    @include('components.NavBar.aside')

    <div class="wrapper-of-playlist">
        @include('components.NavBar.profile')
        <nav class="all-playlists">
            <div class="content">
                @foreach ($playlists as $playlist)
                    <a href="{{route('playlist.show', [$user, $playlist->id])}}" style="all: unset">
                        @include('components.profile.playlist_reduced', [
                            'photo' => Storage::url($playlist->photo),
                            'name' => $playlist->name, 'description' => $playlist->description,
                        ])
                    </a>
                @endforeach
            </div>
        </nav>
        @include('components.buttons.NewPost')
    </div>

    @include('components.posts.NewPlaylist')

    <script src="{{ Vite::asset('resources/js/showallplaylist.js') }}"></script>

@endsection