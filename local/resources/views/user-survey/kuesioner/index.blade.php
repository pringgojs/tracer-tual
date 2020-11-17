@extends('layout')

@section('content')
    @include('user-survey.kuesioner._bread-crumb')
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
                                <th>Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=0;?>
                            @foreach($list_kuesioner as $kuesioner)
                            <tr>
                                <td>{{++$i}}</td>
                                <td>{{ $kuesioner->kuesioner}}</td>
                                <td>{{ $kuesioner->periode->name}}</td>
                                <td>
                                    <form action="{{url('user-survey/kuesioner/'.$kuesioner->id)}}" method="post">
                                        {!! csrf_field() !!}
                                        <a class="btn btn-success" href="{{url('user-survey/kuesioner/'.$kuesioner->id.'/copy')}}" data-toggle="tooltip" data-original-title="Copy"> <i class="fa fa-copy"></i> </a>
                                        <a class="btn btn-info" href="{{url('user-survey/kuesioner/'.$kuesioner->id.'/edit')}}" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil"></i> </a>
                                        <input type="hidden" name="_method" value="delete" />
                                        <button onclick="return confirmation();" class="btn btn-danger" data-toggle="tooltip" data-original-title="scri"> <i class="fa fa-close"></i> </button>
                                    </form>
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