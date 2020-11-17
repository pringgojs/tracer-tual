@extends('layout')

@section('content')

    <div class="row">
        <!-- column -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-block">
                    <h4 class="card-title">Laporan </h4>
                    <h6 class="card-subtitle">Laporan Pekerjaan Alumni </h6>
                    <div class="pull-right text-center">{{ $alumni_answer_description->links('vendor.pagination.bootstrap-4') }}</div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th >#</th>
                                    <th >Nama Pekerjaan</th>
                                    <th >Jumlah Alumni Yang Bekerja</th>
                                    <th >Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=0;?>
                                @foreach($alumni_answer_description as $description)
                                <tr>
                                    <td>{{++$i}}</td>
                                    <td>{{ $description->description}}</td>
                                    <td>{{ $description->jumlahAlumni()}} Orang</td>
                                    <td>
                                        <a class="btn btn-info" href="{{url('report/detail?name='.$description->description)}}" data-toggle="tooltip" data-original-title="report"> <i class="fa fa-eye"></i> </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="pull-right text-center">{{ $alumni_answer_description->links('vendor.pagination.bootstrap-4') }}</div>
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
                $('#modal-detail').modal('show');
                $("#modal-detail").html(result);
            }, error: function(result){
                alert("Failed something went wrong");
            }
        });
    }

</script>
@stop