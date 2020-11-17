<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" >{{$schedule->name}}</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <form method="post" id="form-set-kuesioner">
            {!! csrf_field() !!}
            <input type="hidden" name="schedulee_id" value="{{$schedule->id}}">
            <div class="modal-body col-lg-12">
                <div class="table-responsive">
                    <table class="table color-table info-table">
                        <thead>
                        <tr>
                            <th style="background:#fff">
                                <input type="checkbox" id="checkAll" class="filled-in"/>
                                <label for="checkAll"></label>
                            </th>
                            <th class="align-middle">Kuesioner</th>
                        </tr>
                        </thead>
                        @foreach($list_kuesioner as $kuesioner)
                        <?php
                        $set_kueisoner = \App\Models\KuesionerSchedulee::where('kuesioner_id', $kuesioner->id)->where('schedulee_id', $schedule->id)->first();
                        ?>
                        <tr>
                            <td>
                                <input name="kuesioner_id[]" value="{{$kuesioner->id}}" type="checkbox" @if($set_kueisoner) checked @endif id="kuesioner-id-{{$kuesioner->id}}" class="filled-in"/>
                                <label for="kuesioner-id-{{$kuesioner->id}}"></label>
                            </td>
                            <td>{{$kuesioner->kuesioner}} {!!$kuesioner->isPublished()!!} <br><i class="text-warning" style="font-size:12px">{{$kuesioner->group->name}}</i class="text-warning"></td>
                        </tr>   
                        @endforeach 
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="store()" class="btn btn-info">Submit</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </form>
    </div>
</div>

<script>
    $("#checkAll").click(function(){
        $('input:checkbox').not(this).prop('checked', this.checked);
    });

    function store() {
        var kuesioner_id = document.getElementsByName('kuesioner_id[]');
        var is_falid = false;
        for (i=0; i < kuesioner_id.length; i++) {
            if (kuesioner_id[i].checked) { 
                is_falid = true; 
            }
        }
        if (! is_falid) {
            alert('You have not selected a questionnaire yet');
            return false;
        }
        var data = $( '#form-set-kuesioner' ).serialize();
        $.ajax({
            url: '{{url("schedule/set-kuesioner")}}',
            method: 'POST',
            data: data,
            success: function(res) {
                $('#modal-detail').modal('hide');
                console.log(res);
            },
            error: function(res) {
                console.log(res);
            },
        })
    }
</script>

