<div id="blacki"></div>
<div class="cofnew">
    <form action="{{route('playlist.store', $user)}}" method="POST" class="carta-contenedora" enctype="multipart/form-data">
        {{ $errors }}
        <div class="header-carta">
            <span class="bi bi-arrow-left chao" ></span>
            <span>Lets see your new platlist!</span>
        </div>
        @csrf
        <div class="encabezado">
            <input name="name" type="text" placeholder="Name of the playlist" class="inputen">
        </div>
        <div class="encabezador">
            <input name="description" type="text" placeholder="Description" class="inputen">
        </div>
        <div class="fotodelpost">
            <input name="photo" type="file" id="imageInput" accept="image/*" style="display: none;">
            <label for="imageInput" class="label-upload">
                <i class="bi bi-camera"></i><span>Upload photo</span>
            </label>
            <div class="image-preview" id="imagePreview">
                <span>Nothing photo selected</span> <!-- Mensaje predeterminado -->
            </div>
        </div>
        <div>
            <button class="publi">
                <span>Publish</span>
                <div class="top"></div>
                <div class="lefti"></div>
                <div class="bottom"></div>
                <div class="righti"></div>
            </button>
        </div>
    </form>
</div>