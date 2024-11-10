<div class="part">
    <div class="otra">
        <span class="name-play">{{ $FromName }}</span>
        <div class="rating">
            @for($i = 5; $i >= 1; $i--)
                <input value="{{ $i }}" name="rating" id="star{{ $i }}" type="radio" disabled>
                <label @if($i <= $qualify) class="YellowColor" @endif for="star{{ $i }}"></label>
            @endfor
        </div>
    </div>
</div>