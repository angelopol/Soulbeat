@php
    if(!isset($id)) $id = 'blacki';
    if(!isset($class)) $class = 'followersss';
    if(!isset($label)) $label = 'Followers';
@endphp
<div id="{{$id}}"></div>
    <div class="{{$class}}">
        <div class="cartadeseguidores">
            <span class="text14"> <i class="bi bi-arrow-left atrasmodal"></i>{{$label}}</span>
            <div class="cartaentera">
                @foreach ($followers as $follower)
                    <div class="seguidores">
                        <img class="picture" src="{{Storage::url($follower->photo)}}" alt="">
                        <span class="namess">{{$follower->UserName}}</span>
                        @if($follower->id != auth()->user()->id)
                            @if(!isset($unfollow))
                                <button class="button-follow" UserName="{{ $follower->UserName }}">Follow</button>
                            @else
                                <button class="button-unfollow" UserName="{{ $follower->UserName }}">Unfollow</button>
                            @endif
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>