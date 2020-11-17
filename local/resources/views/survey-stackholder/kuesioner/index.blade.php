@extends('layout')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card p-20">
                <div class="card-header">
                    <h3 class="box-title m-b-0">Kuesioner</h3>
                    <p class="text-muted m-b-30 font-13"> Daftar pertanyaan untuk user survey </p>
                </div>
                <div class="table-responsive" id="data-kuesioner"> 
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Kuesioner</th>
                                <th>Periode</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=0;?>
                            @foreach($list_kuesioner as $kuesioner)
                            <tr>
                                <td>{{++$i}}</td>
                                <td>{{ $kuesioner->kuesioner}}</td>
                                <td>{{ $kuesioner->periode->name}}</td>
                                <td class="text-nowrap ">
                                    <a class="btn btn-success"  onclick='showKuesioner("{{url('survey-stackholder/kuesioner/'.$kuesioner->id)}}")' data-toggle="tooltip" data-original-title="Detail"> <i class="fa fa-eye"></i> </a>
                                    <a class="btn btn-info"  onclick='showKuesioner("{{url('survey-stackholder/kuesioner/'.$kuesioner->id.'/chart')}}")' data-toggle="tooltip" data-original-title="Pengaturan Grafik"> <i class="fa fa-cogs"></i> </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="pull-right">
                    {{ $list_kuesioner->links( "pagination::bootstrap-4") }}
                </div>
            </div>
        </div>
    </div>
    <div class="modal hide fade" id="modal-detail" tabindex="-1" role="dialog"></div>
    
@stop

@section('scripts')
<script>
    function showKuesioner(url) {
        $.ajax({
            url: url,
            success: function(result){
                $("#modal-detail").html(result);
                $('#modal-detail').modal('show');
            }, error: function(result){
                alert("Failed something went wrong");
            }
        });
    }

    function loadPage(url) {
        $.ajax({
            url:url,
            success: function(res) {
                $('#data-kuesioner').html(res);
            },
            error: function(res) {
                console.log(res);
            }
        })
    }

</script>
@stop