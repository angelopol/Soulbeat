@include('components.settings.item')
    <div>
        <span>Name: {{ $PersonName }}</span>
    </div>
    <div>
        <span>Last name: {{ $LastName }}</span>
    </div>
    <form action="{{ route('company.user.destroy', $user) }}">
        @csrf @method('DELETE')
        <button type="submit" id="eli">Eliminar</button>
    </form>
@include('components.settings.item', ['close' => true])