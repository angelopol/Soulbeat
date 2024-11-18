<div class="sugerencia">
    <a href="{{route('profile.post.view', $user)}}" style="all: unset">
        <span class="meh">
            <img src="{{ $photo }}" alt="" class="fotofollow">
            <span class="namefollow">{{ $name }}
                @if(isset($verify))<i class="bi bi-patch-check-fill check"></i>@endif
            </span>
        </span>
    </a>
    <button class="botonseguir" UserName="{{ $name }}">Follow</button>
</div>