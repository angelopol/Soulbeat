@extends('layouts.base')

@section('title') {{$CurrentUser->UserName}} @php $css = "profilestyle" @endphp @endsection

@section('content')
    @include('components.NavBar.aside')

    <div class="right">
        <div class="card-profile"> 
            <div class="profile-photo">
                @if($CurrentUser->photo)
                    <img src="{{ Storage::url($CurrentUser->photo) }}" alt="Foto de Perfil" class="profile-picture">
                @endif
                <div class="profile-info">
                    <span class="name">{{ $CurrentUser->UserName }} 
                        @if($CurrentUser->subscribed == 1)<i class="bi bi-patch-check-fill mora"></i>@endif
                    </span>
                </div>
            </div>
            @if($CurrentUser->id != auth()->user()->id)
                <div class="profile-info">
                    @if(!str_contains(auth()->user()->followed, '~'.$CurrentUser->id.'~'))
                        <button class="button-follow padding-bottom" UserName="{{ $CurrentUser->UserName }}">Follow</button>
                    @else
                        <button class="button-unfollow padding-bottom" UserName="{{ $CurrentUser->UserName }}">Unfollow</button>
                    @endif
                    <form action="">
                        <button class="button-message padding-bottom">Send message</button>
                    </form>
                </div>
            @endif
            <div class="container">
                <div class="content">
                    <div class="item1 followers items">
                        <span class="text"><i class="bi bi-person-hearts"></i>Followers</span>
                        <span class="numelo " id="contador">0</span>
                        <span id="CountFollowers" hidden>{{ count($followers) }}</span>
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
                        <span id="CountFollowed" hidden>{{ count($followed) }}</span>
                    </div>
                    
                    <div class="item4 playlist items">
                        <a href="{{ route('playlist.view', $CurrentUser) }}" style="all: unset">
                            <span class="text-spe"> <i class="bi bi-music-note-list no"></i>Playlists</span>
                        </a>
                        <div class="players">
                            @foreach ($playlists as $playlist)
                                <a href="{{ route('playlist.show', [$CurrentUser, $playlist]) }}" style="all: unset">
                                    @include('components.profile.playlist', [
                                        'photo' => Storage::url($playlist->photo), 'name' => $playlist->name, 'description' => $playlist->description
                                    ])
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="item5 reviews items">
                        <a href="{{ route('profile.reviews.view', $CurrentUser) }}" style="all: unset">
                            <span class="text-spe" id = "x"><i class="bi bi-chat-square-heart-fill"></i>Reviews</span>
                            <div class="content-reviews">
                                @foreach ($reviews as $review)
                                    @include('components.profile.review', [
                                        'qualify' => $review->qualify, 'FromName' => $review->PersonName.' '.$review->PersonFullName
                                    ])
                                @endforeach
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @include('components.buttons.NewPost')
    </div>

    <div id="overlay"></div>
    @include('components.posts.NewPost')
    @include('components.profile.followers', ['followers' => $followers])
    @include('components.profile.followed', ['followed' => $followed])

    <script src="{{ Vite::asset('resources/js/profilescript.js') }}" defer></script>
    <script src="{{ Vite::asset('resources/js/CreatePost.js') }}" defer></script>
    <script src="{{ Vite::asset('resources/js/NewPosts.js') }}"></script>
@endsection