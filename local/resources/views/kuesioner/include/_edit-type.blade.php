
<div class="form-group">
    <label>Jenis inputan</label>
    <div class="demo-radio-button">
        <input name="type_of_field" value="text" type="radio" id="type_of_field1" @if($kuesioner->type_of_field == 'text') checked @endif />
        <label for="type_of_field1">Text</label>
        <input name="type_of_field" value="number" type="radio" @if($kuesioner->type_of_field == 'number') checked @endif id="type_of_field2" />
        <label for="type_of_field2">Angka</label>
    </div>
</div>