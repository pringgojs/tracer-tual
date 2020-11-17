<div class="form-group">
    <label>Izinkan jawaban lain ?</label>
    <div class="col-md-4">
        <div class="switch">
            <label>Tidak
                <input type="checkbox" @if($kuesioner->add_other_answer) checked @endif value=1 name="add_other_answer"><span class="lever"></span>Ya</label>
        </div>
    </div>
</div>