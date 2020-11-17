<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th class="text-center" style="width:3%">#</th>
            <th style="width:30%">Kuesioner</th>
            <th>Jenis Inputan</th>
            <th style="width:30%">Menggunakan Logic ?</th>
            {{-- <th>Group</th> --}}
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $i=1;?>
        @foreach($list_kuesioner as $kuesioner)
        <tr kuesioner-id="{{$kuesioner->id}}" id="kuesioner-{{$kuesioner->id}}">
            <td class="text-center">{{$i}}</td>
            <td id="notes-{{$kuesioner->id}}">{{$kuesioner->kuesioner}} {!!$kuesioner->isPublished()!!} </td>
            <td id="model-{{$kuesioner->id}}">{{$kuesioner->modelAnswer->name}}</td>
            <td id="logic-{{$kuesioner->id}}">{!! $kuesioner->showLogic($kuesioner)!!}</td>
            {{-- <td id="group-{{$kuesioner->id}}">{{$kuesioner->group->name}}</td> --}}
            <td clas="text-nowrap pull-right">
                <form action="{{url('kuesioner/'.$kuesioner->modelAnswer->name.'/'.$kuesioner->id)}}" method="post">
                    {!! csrf_field() !!}
                    <a  class="btn btn-warning" onclick='showKuesioner("{{url('kuesioner/'.$kuesioner->id.'/setting')}}")' data-toggle="tooltip" data-original-title="Pengaturan grafik di beranda"><i class="fa fa-cogs"></i></a>
                    <a class="btn btn-primary" onclick='showKuesioner("{{url('kuesioner/'.$kuesioner->id.'/show')}}")' data-toggle="tooltip" data-original-title="Detail"> <i class="fa fa-eye"></i> </a>
                    <a class="btn btn-info" href="{{url('kuesioner/'.$kuesioner->modelAnswer->name.'/'.$kuesioner->id.'/edit')}}" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil"></i> </a>
                    <input type="hidden" name="_method" value="delete" />
                    <button class="btn btn-danger" data-toggle="tooltip"  onclick="return confirmation();" data-original-title="Hapus"> <i class="fa fa-close"></i> </button>
                </form>
            </td>
        </tr>
        <?php $i++;?>
        @endforeach
    </tbody>
</table>

<script>
    $(document).ready(function () {
        // $('tbody').sortable({
        //     axis: 'y',
        //     stop: function (event, ui) {
        //         var data = $(this).sortable('serialize');
        //         $.ajax({
        //             data: { "_token": "{{ csrf_token() }}", data},
        //             type: 'POST',
        //             url: '{{url("kuesioner/sort")}}',
        //             success: function(res) {
        //                 console.log(res);
        //             },
        //         });
        //     }
        // });
    });
</script>