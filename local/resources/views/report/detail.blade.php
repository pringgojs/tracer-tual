@extends('layout')

@section('content')

    <div class="row">
        <!-- column -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-block">
                    <h4 class="card-title">Laporan Detail</h4>
                    <h6 class="card-subtitle">Laporan Pekerjaan Alumni Detail </h6>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th >#</th>
                                    <th >Nama Alumni</th>
                                    <th >Alamat</th>
                                    <th >Angkatan</th>
                                    <th >Jurusan </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=0;?>
                                @foreach($alumni_answer as $alumni)
                                <tr>
                                    <td>{{++$i}}</td>
                                    <td>{{ $alumni->name}}</td>
                                    <td>{{ $alumni->address}}</td>
                                    <td>{{ $alumni->year_of_entry}}</td>
                                    <td>{{ \App\Models\ProgramStudy::find($alumni->program_study)->jurusan}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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