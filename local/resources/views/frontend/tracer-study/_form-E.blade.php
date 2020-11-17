<div class="col-md-12">
    <div class="node-question">
        <p>{{ $kuesioner->kuesioner }}</p>
    </div>

    @foreach ($kuesioner->multipleChoice as $item)
    <div class="checkbox node-answer" id="node-answer-{{$item->id}}" onclick="itemClickCheckbox({{$item->id}})">
        <label><input type="checkbox" id="checkbox-{{$item->id}}" name="item_id[]" value="{{$item->id}}"> {{$item->notes}}</label>
    </div>
    @endforeach

    @if($kuesioner->add_other_answer)
    <div class="checkbox node-answer" id="node-answer-{{id_item_other_answer()}}" onclick="itemClickCheckbox({{id_item_other_answer()}})">
        <label><input type="checkbox" id="checkbox-{{id_item_other_answer()}}" name="item_id[]" value="{{id_item_other_answer()}}"> Lainnya</label>
    </div>
    <div id="wrap-jawaban-lain"></div>
    

    @endif
    
</div>
