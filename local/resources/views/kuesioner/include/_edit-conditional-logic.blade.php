<div class="form-group">
    <label>Pertanyaan butuh logic ?</label>
    <div class="col-md-4">
        <div class="switch">
            <label>Tidak
            <input type="checkbox" @if($kuesioner->logic->count() > 0) checked @endif value=1 name="is_logic" id="is-logic" onclick="showLogic()"><span class="lever"></span>Ya</label>
        </div>
    </div>
</div>

<div class="form-group bg-faded" style="display:@if(!$kuesioner->logic->count() > 0) none @endif">
    <label for="">Tampilkan pertanyaan JIKA</label>
    <table id="table-logic" class="table table-responsive table-border" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th  width='450px'>Pertanyaan</th>
                <th  width='450px'>Tampilkan Jika Jawaban</th>
                <th></th>
            </tr>
        </thead>
        <tfoot>
            <?php $i = 100;?>
            @foreach ($kuesioner->logic as $logic)
                
            <tr id="tr-logic-{{$logic->id}}">
                <td>
                    <select class="form-control" name="action_logic_kuesioner[]" onchange="getAnswer(this.value, {{$i}})" id="action-logic-kuesioner-{{$i}}">
                        <option value="">Pilih kuesioner</option>
                        @foreach($list_kuesioner_model_c as $kuesioner_c)
                        <option value="{{$kuesioner_c->id}}" @if($kuesioner_c->id == $logic->kuesioner_id_ref) selected @endif>{{$kuesioner_c->kuesioner}}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <select class="form-control" name="action_logic_kuesioner_item[]" id="action-logic-kuesioner-item-{{$i}}">
                        <option value="">Pilih jawaban</option>
                        @foreach($logic->ref->multipleChoice as $item)
                        <option value="{{$item->id}}" @if($item->id == $logic->kueswer_multiple_choice_itm_id) selected @endif>{{$item->notes}}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <a href="javascript:void(0)" class="remove-row" onclick="removeLogic({{$logic->id}})"><i class="fa fa-remove"></i></a>
                </td>
            </tr>
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td><div class="btn btn-success btn-sm btn-circle" onclick="addRowTableLogic()" id="addRowTableLogic"><i class="fa fa-plus"></i></div></td>
            </tr>

        </tfoot>
    </table>

</div>
<div class="form-group">
    <button type="submit" class="btn btn-primary">Simpan</button>
</div>