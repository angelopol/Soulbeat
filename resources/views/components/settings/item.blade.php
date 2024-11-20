@if(!isset($close))
    <div class="card">
        <div class="tarjeta"  onclick="toggleCard(this)">
            <div>
                <span class="nombre">{{ $name }}</span>
                <span class="seccion">{{ $description }}</span>
            </div>
            <span class="bi bi-caret-down-fill arrow"></span>
        </div>
        <div class="content-tarjet miformula">
            <div id="license-form" class="miformula">
@else
            </div>
            <br>
        </div>
    </div>
@endif