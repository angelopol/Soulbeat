@include('components.settings.item')
    <div>
        <label for="cardholder-name">Question</label>
        <input type="text" id="cardholder-name2" name="cardholder-name" required>
    </div>

    <div>
        <label for="license-description">answer</label>
        <textarea id="license-description" name="license-description" required></textarea>
    </div>
    <div>
        <button class="est toggle-button">Activo</button>
    </div>
    <button type="submit" id="modi">Modificar</button>
    <button type="submit" id="eli">Eliminar</button>
@include('components.settings.item', ['close' => true])