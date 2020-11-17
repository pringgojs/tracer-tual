@extends('layout')

@section('content')

    @include('period.bread-crumb')
    <div class="row">
        <!-- column -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-block">
                    <h4 class="card-title">Periode Pengisian</h4>
                    <h6 class="card-subtitle">Periode pengisian dari tahun lulus alumni</h6>
                    <div class="pull-right text-center">{{ $list_period->links('vendor.pagination.bootstrap-4') }}</div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Periode</th>
                                    <th>Batas Bawah <br> (berapa bulan dari tahun lulus)</th>
                                    <th>Batas Atas <br>(berapa bulan dari tahun lulus)</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=0;?>
                                @foreach($list_period as $period)
                                <tr>
                                    <td>{{++$i}}</td>
                                    <td>{{ $period->name}}</td>
                                    <td>{{ $period->lower_limit}} bulan</td>
                                    <td>{{ $period->upper_limit}} bulan</td>
                                    <td>
                                        <form action="{{url('period/'.$period->id)}}" method="post">
                                            {!! csrf_field() !!}
                                            <a class="btn btn-info" href="{{url('period/'.$period->id.'/edit')}}" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil"></i> </a>
                                            <input type="hidden" name="_method" value="delete" />
                                            <button class="btn btn-danger" onclick="return confirmation();" data-toggle="tooltip" data-original-title="hapus"> <i class="fa fa-close"></i> </button>
                                            <a class="btn btn-success" onclick="setKuesioner('{{url("period/set-kuesioner/".$period->id)}}')" data-toggle="tooltip" data-original-title="Atur Kuesioner"> <i class="fa fa-paper-plane"></i> Atur Kuesioner</a>
                                            <a class="btn btn-primary" href="{{url('period/'.$period->id.'/kuesioner-order')}}" data-toggle="tooltip" data-original-title="Susun ulang kuesioner"> <i class="fa fa-drag"></i> Susun ulang kuesioner </a>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="pull-right text-center">{{ $list_period->links('vendor.pagination.bootstrap-4') }}</div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="modal-detail" tabindex="-1" role="dialog"></div>

@stop
@section('scripts')
<script>

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