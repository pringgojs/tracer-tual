<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th class="text-center" style="width:3%">#</th>
            <th style="width:30%">Kuesioner</th>
            <th>Jenis Inputan</th>
            <th style="width:30%">Menggunakan Logic ?</th>
        </tr>
    </thead>
    <tbody>
        <?php $i=1;?>
        @foreach($list_kuesioner_periode as $kuesioner_periode)
        <?php $kuesioner = $kuesioner_periode->kuesioner;?>
        <tr style="cursor:move" kuesioner-id="{{$kuesioner->id}}" id="kuesioner-{{$kuesioner->id}}">
            <td class="text-center">{{$i}}</td>
            <td id="notes-{{$kuesioner->id}}">{{$kuesioner->kuesioner}} {!!$kuesioner->isPublished()!!} </td>
            <td id="model-{{$kuesioner->id}}">{{$kuesioner->modelAnswer->name}}</td>
            <td id="logic-{{$kuesioner->id}}">{!! $kuesioner->showLogic($kuesioner)!!}</td>
        </tr>
        <?php $i++;?>
        @endforeach
    </tbody>
</table>

<script>
    $(document).ready(function () {
        $('tbody').sortable({
            axis: 'y',
            stop: function (event, ui) {
                var data = $(this).sortable('serialize');
                $.ajax({
                    data: { "_token": "{{ csrf_token() }}", data, "periode_id": {{$periode->id}}},
                    type: 'POST',
                    url: '{{url("period/kuesioner-order")}}',
                    success: function(res) {
                        notification('Berhasil', 'Susunan berhasil disimpan');
                        console.log(res);
                    },
                    error: function (res) {
                        notification('Gagal', 'Susunan gagal disimpan');
                        console.log(res);
                    }
                });
            }
        });
    });
</script>