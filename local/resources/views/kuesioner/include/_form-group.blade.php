<div class="form-group">
    <div class="row">
        <div class="col-md-8">
            <label>Kuesioner Group</label>
            <select class="form-control" name="group" onchange="getKuesioner(this.value)" id="grup-kuesioner">
                <option>-</option>
                @foreach($list_group as $group)
                <option value="{{$group->id}}">{{$group->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>