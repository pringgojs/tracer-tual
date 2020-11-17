<div class="form-group">
    <div class="row">
        <div class="col-md-8">
            <label>Kuesioner Group*</label>
            <select class="form-control" name="group" onchange="getKuesioner(this.value)" id="grup-kuesioner">
            @foreach($list_group as $group)
            <option value="{{$group->id}}" @if($kuesioner->kuesioner_group_id == $group->id) selected @endif>{{$group->name}}</option>
            @endforeach
            </select>
        </div>
    </div>
</div>