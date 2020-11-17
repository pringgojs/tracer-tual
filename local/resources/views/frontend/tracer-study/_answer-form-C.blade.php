<div class="col-md-12">
    <div class="node-question">
        <p>{{ $kuesioner->kuesioner }}</p>
    </div>

    @foreach ($kuesioner->multipleChoice as $item)
    <?php
    $checked = "";
    $active = "";
    if ($alumni_answer->answerMultipleChoice->kueswer_multiple_choice_id == $item->id) {
        // dd($alumni_answer->answerMultipleChoice->kueswer_multiple_choice_id);
        $checked = "checked='checked'";
        $active = "activex";
    }
    ?>
    <div class="radio node-answer {{$active}}" id="node-answer-{{$item->id}}">
        <label><input type="radio" {{$checked}} readonly disabled id="radio-{{$item->id}}" name="item_id" value="{{$item->id}}"> {{$item->notes}}</label>
    </div>
    @endforeach

    @if($kuesioner->add_other_answer)
    <div class="radio node-answer" id="node-answer-1000" onclick="itemClick(1000)">
        <label><input type="radio" id="radio-1000" name="item_id" value="1000"> Lainnya</label>
    </div>
    <div id="wrap-jawaban-lain"></div>

    @endif
    
</div>
