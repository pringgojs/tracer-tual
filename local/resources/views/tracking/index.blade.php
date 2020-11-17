@extends('layout')

@section('styles')
<style>
    .time {
        font-weight: 400;
        margin: 0 auto;
        text-align: center;
        font-size:35px;
    }
</style>
    
@endsection
@section('content')
    @include('tracking._bread-crumb')
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-success">
                <strong>Jurusan :</strong> {{auth()->user()->surveyor->programStudy->jurusan_lengkap}} <br>
                <strong>Angkatan :</strong> {{auth()->user()->surveyor->generation}}
            </div>
        </div>
    </div>
    <div class="row">
        <!-- Column -->
        <div class="col">
            <div class="card card-body">
                <!-- Row -->
                <div class="row" style="padding:10px">
                    <!-- Column -->
                    <div class="col p-r-0 align-self-center">
                        <h2 class="font-light m-b-0" style="font-size:28px; font-weight: 600">{{\NumberHelper::formatQuantity($target_participant, 0)}}</h2>
                        <h6 class="text-muted">Target Peserta</h6>
                    </div>
                </div>
            </div>
        </div>

        <!-- Column -->
        <div class="col">
            <div class="card card-body">
                <!-- Row -->
                <div class="row" style="padding:10px">
                    <!-- Column -->
                    <div class="col p-r-0 align-self-center">
                        <h2 class="font-light m-b-0" style="font-size:28px; font-weight: 600">{{\NumberHelper::formatQuantity($participant_done, 0)}}</h2>
                        <h6 class="text-muted">Total Sudah Entry</h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card card-body">
                <!-- Row -->
                <div class="row" style="padding:10px">
                    <!-- Column -->
                    <div class="col p-r-0 align-self-center">
                        <h2 class="font-light m-b-0" style="font-size:28px; font-weight: 600">{{\NumberHelper::formatQuantity($target_participant-$participant_done, 0)}}</h2>
                        <h6 class="text-muted">Total Belum Entry</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- column -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-block">
                    <h4 class="card-title">Peserta Belum Entry</h4>
                    <h6 class="card-subtitle"></h6>
                    <a href="{{url('tracking/download/'.\Input::get('filter'))}}"><button class="btn btn-info">Download Excel</button></a>
                    <select name="" id="filter" onchange="location.href='tracking?filter='+this.value" class="form-control col-md-2">
                        <option value="all" @if(\Input::get('filter') == 'all') selected @endif>Semua</option>
                        <option value="0" @if(\Input::get('filter') == '0') selected @endif>Belum Entry</option>
                        <option value="1" @if(\Input::get('filter') == '1') selected @endif>Sudah Entry</option>
                    </select>
                    <div class="pull-right">
                    {{ $list_participant_pending->appends(['filter' => \Input::get('filter')])->links( "pagination::bootstrap-4") }}
                    </div>

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>NRP</th>
                                    <th>Jurusan</th>
                                    <th>Angkatan</th>
                                    <th>Tahun Lulus</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($list_participant_pending as $row => $participant_pending)
                                <?php
                                $label = '<label class="label label-rounded bg-danger">Belum Entry</label>';
                                if (in_array($participant_pending->nrp, $list_participant_done)) {
                                    $label = '<label class="label label-rounded bg-success">Sudah Entry</label>';
                                }
                                ?>
                                <tr>
                                    <td>{{$row+1}}</td>
                                    <td>{{ $participant_pending->nama }}</td>
                                    <td>{{ $participant_pending->nrp }}</td>
                                    <td>{{ $participant_pending->classes->programStudy->jurusan_lengkap }}</td>
                                    <td>{{ $participant_pending->angkatan }}</td>
                                    <td>{{ $participant_pending->tahun_lulus }}</td>
                                    <td>{!! $label !!}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="pull-right">
                    {{ $list_participant_pending->appends(['filter' => \Input::get('filter')])->links( "pagination::bootstrap-4") }}
                    </div>
                </div>
            </div>
        </div>

        
    </div>
{{--     
    <div class="row">
        <!-- column -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-block">
                    <h4 class="card-title">Peserta Sudah Entry</h4>
                    <h6 class="card-subtitle"></h6>
                    <a href="{{url('tracking/download/1')}}"><button class="btn btn-info">Download Excel</button></a>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>NRP</th>
                                    <th>Jurusan</th>
                                    <th>Angkatan</th>
                                    <th>Tahun Lulus</th>
                                    <th>Tgl. Entry</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($list_participant_done as $participant_done)
                                <tr>
                                    <td>{{ $participant_done->name }}</td>
                                    <td>{{ $participant_done->nrp }}</td>
                                    <td>{{ $participant_done->programStudy->jurusan_lengkap }}</td>
                                    <td>{{ $participant_done->generation }}</td>
                                    <td>{{ $participant_done->year_of_graduated }}</td>
                                    <td>{{ \Carbon\Carbon::parse($participant_done->created_at)->format('d M Y H:i:s') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        
    </div>
     --}}
    <script language="JavaScript">
        TargetDate = '{{$schedule->end_date}}';
        DisplayFormat = "%%H%%:%%M%%:%%S%%";
        FinishMessage = "WAKTU HABIS";
    </script>
@stop

@section('scripts')
<script type="text/javascript" src="{{asset('js/timer-schedule.js')}}"></script>
@endsection