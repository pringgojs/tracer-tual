@extends('layout')

@section('content')
    @include('participant._bread-crumb')
    <div class="row">
        <!-- column -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-block">
                    <h4 class="card-title">Alumni</h4>
                    <h6 class="card-subtitle">Alumni yang sudah mengisi Tracer Study</h6>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>NIM </th>
                                    <th>Program Studi </th>
                                    <th>Angkatan </th>
                                    <th>Tgl. Lulus </th>
                                    <th>Email </th>
                                    <th>Tlp </th>
                                    <th>Jawaban </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=0;?>
                                @foreach($list_participant as $participant)
                                <tr>
                                    <td>{{++$i}}</td>
                                    <td>{{ $participant->name}}</td>
                                    <td>{{ $participant->nrp}}</td>
                                    <td>{{ $participant->program->program}} - {{ $participant->programStudy->jurusan_lengkap}}</td>
                                    <td>{{ $participant->generation}}</td>
                                    <td>{{ $participant->year_of_graduated}}</td>
                                    <td>{{ $participant->email}}</td>
                                    <td>{{ $participant->phone}}</td>
                                    <td>
                                        <a target="_blank" class="btn btn-primary" href="{{url('participant/'.$participant->id.'/answer')}}")' data-toggle="tooltip" data-original-title="Lihat Jawaban"> <i class="fa fa-file"></i> </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="pull-right">
                        {{ $list_participant->links( "pagination::bootstrap-4") }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
