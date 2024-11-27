@extends('layouts.base')

@section('title') {{$playlist->name}} @php $css = "playlist" @endphp @endsection

@section('content')
    @include('components.NavBar.aside')

    <div class="wrapper-of-playlist">
        <section class="main-playlist">
            <nav class="up-playlist">
                <div class="flex">
                    <img class="foto-playlist" src="{{ Storage::url($playlist->photo) }}" alt="">
                    <div class="info-playlist">
                    <h1 class="title-playlist">{{$playlist->name}}</h1>
                    <span class="caracteristic">{{$playlist->description}}</span>
                    </div>
                </div>
                <div>
                    <i class="bi bi-pencil"></i>
                </div>
            </nav>
        </section>
    
        <section class="show-songs">
            @foreach (explode('~', $playlist->posts) as $post)
                @if(is_numeric($post))
                    @php $post = App\Models\Post::find($post); @endphp
                    @include('components.posts.post_reduced', [
                        'photo' => Storage::url($post->photo),
                        'name' => $post->name, 'description' => $post->description,
                        'song' => Storage::url($post->song)
                    ])
                @endif
            @endforeach
        </section>
    </div>
 
    <script src="/resources/js/playlist.js"> </script>
@endsection