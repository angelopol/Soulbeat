@extends('layouts.base')

@section('title') Profile @php $css = "profilestyle" @endphp @endsection

@section('content')
    @include('components.NavBar.aside')

    <div class="right">
        <div class="card-profile"> 
            <div class="profile-photo">
                @if($user->photo)
                    <img src="{{ Storage::url($user->photo) }}" alt="Foto de Perfil" class="profile-picture">
                @endif
                <div class="profile-info">
                    <span class="name">{{ $user->UserName }} 
                        @if($user->subscribed == 1)<i class="bi bi-patch-check-fill mora"></i>@endif
                    </span>
                </div>
            </div>
            @if($user->id != auth()->user()->id)
                <button class="button-follow padding-bottom">Seguir</button>
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
                        <span class="text-spe"> <i class="bi bi-music-note-list no"></i>Playlists</span>
                        <div class="players">
                            @foreach ($playlists as $playlist)
                                @include('components.profile.playlist', [
                                    'photo' => Storage::url($playlist->photo), 'name' => $playlist->name, 'description' => $playlist->description
                                ])
                            @endforeach
                        </div>
                    </div>
                    <div class="item5 reviews items">
                        <span class="text-spe" id = "x"><i class="bi bi-chat-square-heart-fill"></i>Reviews</span>
                        <div class="content-reviews">
                            @foreach ($reviews as $review)
                                @include('components.profile.review', [
                                    'qualify' => $review->qualify, 'FromName' => $review->PersonName.' '.$review->PersonFullName
                                ])
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('components.buttons.NewPost')
    </div>

    <div id="overlay"></div>
    @include('components.posts.NewPost')
    @php
        $FollowersShow = [];
        foreach ($followers as $key => $follower) {
            $FollowersShow[] = [Storage::url($follower->photo), $follower->UserName];
        }
        $FollowedShow = [];
        foreach ($followed as $key => $follow) {
            $FollowedShow[] = [Storage::url($follow->photo), $follow->UserName];
        }
    @endphp
    @include('components.profile.followers', ['followers' => $FollowersShow])
    @include('components.profile.followed', ['followed' => $FollowedShow])

    <script src="{{ Vite::asset('resources/js/profilescript.js') }}" defer></script>
    <script src="{{ Vite::asset('resources/js/CreatePost.js') }}" defer></script>
    <script src="{{ Vite::asset('resources/js/NewPosts.js') }}"></script>
@endsection