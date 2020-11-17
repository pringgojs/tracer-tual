@extends('layout')

@section('content')
    @include('kuesioner._bread-crumb')
    <div class="row">
        <div class="col-lg-12">
            <div class="card p-20">
                <div class="card-header">
                    <h3 class="box-title m-b-0">Kuesioner Sort</h3>
                    <p class="text-muted m-b-30 font-13"> List of kuesioner </p>
                </div>
                <div class="col-row">
                    <div class="btn-group m-b-10" role="group">
                        <button id="btnGroupDrop1" type="button" class="btn m-b-10 text-dark btn-default p-10 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> Groups </button>
                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 39px, 0px); top: 0px; left: 0px; will-change: transform;"> 
                            @foreach($list_group as $group)
                            <a class="dropdown-item" onclick="orderBy('{{url("kuesioner/sort/group/".$group->id)}}')" >{{$group->name}}</a> 
                            @endforeach
                        </div>
                    </div>
                </div>
                <form id="load-page">
                
                </form>
            </div>
        </div>
    </div>
    
@stop

@section('scripts')
<script>
    function orderBy(url) {
        $.ajax({
            url:url,
            success: function(res) {
                $('#load-page').html(res);
            },
            error: function(res) {
                console.log(res);
            }
        })
    }
    
</script>
@stop