@include('components.settings.item')
    <div>
        <label for="cardholder-name">title</label>
        <input type="text" id="cardholder-name2" name="cardholder-name" required>
    </div>

    <div>
        <label for="license-description">Summary</label>
        <textarea id="license-description" name="license-description" required></textarea>
    </div>
    <div>
        <label for="cardholder-name">File</label>
        <input type="text" id="cardholder-name4" name="cardholder-name" required>
    </div>
    <button type="submit" id="modi">Modificar</button>
    <button type="submit" id="eli">Eliminar</button>
@include('components.settings.item', ['close' => true])