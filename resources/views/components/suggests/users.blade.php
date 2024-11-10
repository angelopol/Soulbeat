<div class="sugerencia">
    <span class="meh">
        <img src="{{ $photo }}" alt="" class="fotofollow">
        <span class="namefollow">{{ $name }}
            @if(isset($verify))<i class="bi bi-patch-check-fill check"></i>@endif
        </span>
    </span>
    <button class="botonseguir" UserName="{{ $name }}">Follow</button>
</div>