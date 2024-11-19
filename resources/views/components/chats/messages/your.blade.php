<div class="message leftchat">
    @if($photo != null and $photo != "" and $photo != "/storage/")
        <img class="fotochat" src="{{ $photo }}" alt="Persona 1">
    @endif
    <div class="content">
        <div class="text">{{ $text }}</div>
        <div class="infochat">
            <div class="namechat">{{ $name }}</div>
            <div class="time">{{ $time }}</div>
        </div>
    </div>
</div>