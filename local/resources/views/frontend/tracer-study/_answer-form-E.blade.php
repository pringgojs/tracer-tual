<div class="col-md-12">
    <div class="node-question">
        <p>{{ $kuesioner->kuesioner }}</p>
    </div>

    @foreach ($kuesioner->multipleChoice as $item)
    <?php
    $checked = "";
    $active = "";
    $cek = \App\Models\AlumniAnswerMultipleChoice::where('alumni_answer_id', $alumni_answer->id)->where('kueswer_multiple_choice_id', $item->id)->first();
    if ($cek) {
        $checked = "checked='checked'";
        $active = "activex";
    }
    ?>
    <div class="checkbox node-answer {{$active}}" id="node-answer-{{$item->id}}">
        <label><input type="checkbox" disabled {{$checked}} id="checkbox-{{$item->id}}" name="item_id[]" value="{{$item->id}}"> {{$item->notes}}</label>
    </div>
    @endforeach

    @if($kuesioner->add_other_answer)
    <div class="checkbox node-answer" id="node-answer-1000" onclick="itemClickCheckbox(1000)">
        <label><input type="checkbox" id="checkbox-1000" name="item_id[]" value="1000"> Lainnya</label>
    </div>
    <div id="wrap-jawaban-lain"></div>
    

    @endif
    
</div>
