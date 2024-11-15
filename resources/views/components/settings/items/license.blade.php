@include('components.settings.item')
    <form method="POST" action="{{ route('licenses.update', $license) }}" style="all: unset">
        @csrf @method('PATCH')
        <div>
            <label for="license-name">Nombre de la Licencia</label>
            <input type="text" id="license-name" name="name">
        </div>
        <div>
            <label for="license-description">Descripción de la Licencia</label>
            <textarea id="license-description" name="feature"></textarea>
        </div>
        <br>
        <button type="submit" id="modi">Modificar</button>
    </form>
    <form action="{{ route('licenses.destroy', $license) }}">
        @csrf @method('DELETE')
        <button type="submit" id="eli">Eliminar</button>
    </form>
@include('components.settings.item', ['close' => true])