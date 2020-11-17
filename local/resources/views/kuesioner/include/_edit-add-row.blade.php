
<div class="form-group"  id="wrap-answer">
    <label>Input jawaban pilihan ganda</label>
    <table id="answer" class="table table-responsive table-border" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th></th>
                <th width='450px'>Jawaban</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kuesioner->multipleChoice as $multiple_choice)
            
            <tr id="tr-multi-item-{{$multiple_choice->id}}">
                <td><a href="javascript:void(0)" onclick="removeMultipleItem({{$multiple_choice->id}})" class="remove-row-{{$multiple_choice->id}}"><i class="fa fa-remove"></i></a></td>
                <td>
                    <input type="hidden" name="item_id[]" value="{{$multiple_choice->id}}">
                    <input type="text" value="{{$multiple_choice->notes}}" name="answer[]"  class="form-control" />
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
        <tr>
            <td></td>
            <td><div class="btn btn-success btn-sm btn-circle" onclick="addRow()" id="addRow"><i class="fa fa-plus"></i></div></td>
        </tr>
        </tfoot>
    </table>
</div>