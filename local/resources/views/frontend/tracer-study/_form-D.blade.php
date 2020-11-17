<div class="col-md-12">
    <div class="node-question">
        <p>{{ $kuesioner->kuesioner }}</p>
    </div>

    <p class="text-info">Keterangan:</p>
    <div class="table-responsive">
        <table class="table table-bordered" style="width:50%">
            <thead>
                <tr>
                    <th style="width:10px">Nilai</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            
            <tbody>
                @foreach ($kuesioner->multipleChoiceItem as $item)
                    <tr>
                        <td>{{$item->value}}</td>
                        <td>{{$item->notes}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <div class="table-responsive">
        <table class="table">
            <thead style="background:#eee">
                <tr>
                    <th rowspan="2" style="width:10px">No</th>
                    <th rowspan="2">Pertanyaan</th>
                    <th class="text-center" colspan="{{$kuesioner->multipleChoiceItem->count()}}">Pilihan</th>
                </tr>
                <tr>
                    @foreach ($kuesioner->multipleChoiceItem as $item)
                        <th>{{$item->value}}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
            @foreach ($kuesioner->multipleChoice as $row => $multiple_choice)
                <input type="hidden" name="multiple_choice_id[]" value="{{$multiple_choice->id}}">
                <tr>
                    <td>{{++$row}}</td>
                    <td>{{$multiple_choice->notes}}</td>
                    @foreach ($kuesioner->multipleChoiceItem as $item)
                        <td>
                            <div class="radio">
                                <label><input required type="radio" name="value_{{$multiple_choice->id}}" value="{{$item->id}}"></label>
                            </div>
                        </td>
                    @endforeach
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    
</div>