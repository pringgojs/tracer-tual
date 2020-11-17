@extends('layout')

@section('content')
    @include('kuesioner._bread-crumb')
    <div class="row">
        <div class="col-lg-12">
            <div class="card p-20">
                <div class="card-header">
                    <h3 class="box-title m-b-0">Kuesioner</h3>
                    <p class="text-muted m-b-30 font-13"> daftar kuesioner tracer study </p>
                </div>
                <div class="col-row">
                    {{-- <div class="btn-group m-b-10" role="group">
                        <button id="btnGroupDrop1"  type="button" class="btn m-b-10 text-dark btn-default p-10 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> Groups </button>
                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 39px, 0px); top: 0px; left: 0px; will-change: transform;"> 
                            <a class="dropdown-item @if(\Request::segment(3) == 'all') active @endif" onclick="loadPage('{{url("kuesioner/group/all")}}')" >All Groups</a> 
                            @foreach($list_group as $group)
                            <a class="dropdown-item @if(\Request::segment(3) == $group->id) active @endif" onclick="loadPage('{{url("kuesioner/group/".$group->id)}}')" >{{$group->name}}</a> 
                            @endforeach
                        </div>
                    </div> --}}
                </div>
                <div class="table-responsive" id="data-kuesioner"> 
                    @include('kuesioner._data-kuesioner')
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
                console.log(result);
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