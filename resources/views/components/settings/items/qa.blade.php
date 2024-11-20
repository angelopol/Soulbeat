@include('components.settings.item')
    <div>
        <label for="cardholder-name">Question</label>
        <input type="text" id="cardholder-name2" name="cardholder-name" required>
    </div>

    <div>
        <label for="license-description">Answer</label>
        <textarea id="license-description" name="license-description" required></textarea>
    </div>
    <button type="submit" id="modi">Modificar</button>
    <button type="submit" id="eli">Eliminar</button>
@include('components.settings.item', ['close' => true])