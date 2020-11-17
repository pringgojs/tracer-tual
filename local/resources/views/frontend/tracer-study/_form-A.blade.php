<div class="col-md-12">
    <div class="node-question">
        <p>{{ $kuesioner->kuesioner }}</p>
    </div>

    <input type="text" name="input" placeholder="tulis jawaban anda disini" required class="{{$kuesioner->type_of_field == 'number' ? 'format-quantity' : ''}} node-answer-input" id="">
    
</div>
