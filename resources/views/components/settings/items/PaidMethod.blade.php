@include('components.settings.item')
    <form method="POST" action="{{ route('paid.methods.update', $PaidMethod) }}" style="all: unset">
        @csrf @method('PATCH')
        <div>
            <label for="license-name">Nombre del metodo de pago</label>
            <input type="text" id="license-name" name="name">
        </div>
        <div>
            <label for="license-description">Descripción del metodo de pago</label>
            <textarea id="license-description" name="description"></textarea>
        </div>
        <button type="submit" id="modi">Modificar</button>
    </form>
    <form action="{{ route('paid.methods.destroy', $PaidMethod) }}">
        @csrf @method('DELETE')
        <button type="submit" id="eli">Eliminar</button>
    </form>
@include('components.settings.item', ['close' => true])