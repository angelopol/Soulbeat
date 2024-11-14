<div class="review">
    <img src="{{ $photo }}" alt="" class="foto">
    <div class="infos">
        <span class="nombre">{{ $name }}</span>
        <span class="descri">{{ $title }}</span>
        <span class="descri">{{ $body }}</span>
        @include('components.profile.rating', ['qualify' => $qualify])
    </div>
</div>