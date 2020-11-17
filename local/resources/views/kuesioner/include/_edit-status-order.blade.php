<div class="form-group">
    <label>Status Publikasi</label>
    <div class="col-md-4">
        <div class="switch">
            <label>Menunggu
                <input type="checkbox" @if($kuesioner->is_published) checked @endif value=1 name="status"><span class="lever"></span>Publikasi</label>
        </div>
    </div>
</div>
{{-- <div class="form-group">
    <label>Nomer Urut</label>
    <input type="number" required id="order_number" required name="order_number" value="{{$kuesioner->order_number}}" class="form-control" placeholder="">
</div> --}}