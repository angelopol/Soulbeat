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
                        <img class="picture" src="{{$follower[0]}}" alt="">
                        <span class="namess">{{$follower[1]}}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>