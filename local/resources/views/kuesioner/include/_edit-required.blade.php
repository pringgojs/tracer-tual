
<div class="form-group">
    <label>Apakah wajib diisi ?</label>
    <div class="demo-radio-button">
        <input name="is_required" value="1" type="radio" id="is_required_1" @if($kuesioner->is_required) checked @endif />
        <label for="is_required_1">Wajib</label>
        <input name="is_required" value="0" type="radio" id="is_required_2" @if(!$kuesioner->is_required) checked @endif/>
        <label for="is_required_2">Optional</label>
    </div>
</div>