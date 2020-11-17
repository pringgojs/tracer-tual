@extends('layout')

@section('content')

    @include('schedule.bread-crumb')
    <div class="row">
        <!-- column -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-block">
                    <h4 class="card-title">Jadwal Tracer Study</h4>
                    <h6 class="card-subtitle">Jadwal dilaksanakan tracer study</h6>
                    <div class="pull-right text-center">{{ $list_schedule->links('vendor.pagination.bootstrap-4') }}</div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tanggal pengisian dimulai</th>
                                    <th>Tanggal pengisian ditutup</th>
                                    <th>Keterangan</th>
                                    <th>Aksi </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=0;?>
                                @foreach($list_schedule as $schedule)
                                <tr>
                                    <td>{{++$i}}</td>
                                    <td>{{ \Carbon\Carbon::parse($schedule->start_date)->format('d, M Y')}}</td>
                                    <td>{{ \Carbon\Carbon::parse($schedule->end_date)->format('d, M Y')}}</td>
                                    <td>{{ $schedule->description}}</td>
                                    <td>
                                        <form action="{{url('schedule/'.$schedule->id)}}" method="post">
                                            {!! csrf_field() !!}
                                            <a class="btn btn-success" onclick="showDetail('{{url('schedule/'.$schedule->id.'/detail')}}')" href="#" data-toggle="tooltip" data-original-title="Lihat Detail"> <i class="fa fa-eye"></i> </a>
                                            <a class="btn btn-info" href="{{url('schedule/'.$schedule->id.'/edit')}}" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil"></i> </a>
                                            <input type="hidden" name="_method" value="delete" />
                                            <button class="btn btn-danger" onclick="return confirmation();" data-toggle="tooltip" data-original-title="scri"> <i class="fa fa-close"></i> </button>

                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="pull-right text-center">{{ $list_schedule->links('vendor.pagination.bootstrap-4') }}</div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal hide fade" id="modal-detail" tabindex="-1" role="dialog"></div>

@stop
@section('scripts')
<script>
    function showDetail(url) {
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

    function setKuesioner(url) {
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

</script>
@stop