<div class="col-md-12">
    <div class="node-question">
        <p>{{ $kuesioner->kuesioner }}</p>
    </div>

    @foreach ($kuesioner->multipleChoice as $item)
    <div class="radio node-answer" id="node-answer-{{$item->id}}" onclick="itemClick({{$item->id}})">
        <label><input type="radio" id="radio-{{$item->id}}" name="item_id" value="{{$item->id}}"> {{$item->notes}}</label>
    </div>
    @endforeach

    @if($kuesioner->add_other_answer)
    <div class="radio node-answer" id="node-answer-{{id_item_other_answer()}}" onclick="itemClick({{id_item_other_answer()}})">
        <label><input type="radio" id="radio-{{id_item_other_answer()}}" name="item_id" value="{{id_item_other_answer()}}"> Lainnya</label>
    </div>
    <div id="wrap-jawaban-lain"></div>

    @endif
    
</div>
