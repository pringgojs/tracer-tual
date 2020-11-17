@extends('layout')

@section('styles')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/gridstack/dist/gridstack.css')}}"/>
<style>
    .tile_stats_count:before {
        content: "";
        position: absolute;
        left: 0;
        height: 65px;
        border-left: 2px solid #ADB2B5;
        margin-top: 10px;
    }
    .tile_stats_count span {
        font-size: 13px;
    }
    .tile_stats_count .count {
        font-size: 40px;
        font-weight: 700
    }

    .number {
        width:50px;
        height:50px;
        border: solid 5px #26c6da; 
        border-radius:100%;
        font-weight:600;
        font-size:20px;
        text-align: center!important;
        padding-top: 3px;
        color: #26c6da; 
    }

    .ctr {
        font-weight:600;
        font-size:20px;
        text-align: center!important;
        color: #FFF; 
        padding-top: 3px;
    }


    /*little-profile*/
    .little-profile .pro-img {
    margin-top: -80px;
    margin-bottom: 20px; }
    .little-profile .pro-img img {
        width: 128px;
        height: 128px;
        -webkit-box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        border-radius: 100%; }

    .contact-box {
    position: relative; }
    .contact-box .add-ct-btn {
        position: absolute;
        right: 4px;
        top: -46px; }
    .contact-box .contact-widget > a {
        padding: 15px 10px; }
        .contact-box .contact-widget > a .user-img {
        margin-bottom: 0px !important; }

    .card-body {
        -ms-flex: 1 1 auto;
        flex: 1 1 auto;
        padding: 1.25rem;
    }
    .highcharts-credits {
        display: none
    }
    .grid-stack {
        {{--  background: lightgoldenrodyellow;  --}}
    }

    .grid-stack-item-content {
        color: #2c3e50;
        text-align: center;
        {{--  background-color: #18bc9c;  --}}
    }
</style>
<script src="{{ asset('assets/plugins/gridstack/dist/gridstack.js') }}"></script>
<script src="{{ asset('assets/plugins/gridstack/dist/gridstack.jQueryUI.js') }}"></script>
@stop
@section('content')
    @include('include.bread-crumb')
    

    <div class="row">
        <!-- Column -->
        <div class="col-12">
            <div class="card">
                <div class="card-block">
                    Filter
                </div>
                <div class="row p-3">
                    <div class="col-lg-3 col-md-3 col-xs-8">
                        <select id="program-study" class="form-control">
                            <option value="0">Semua Departemen</option>
                            @foreach($program_studies as $program_study)
                            <option value="{{$program_study->nomor}}">{{$program_study->jurusan}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-3 col-xs-8">
                        <select id="program" class="form-control">
                            <option value="0">Semua Program Studi</option>
                            @foreach($programs as $generation)
                            <option value="{{$generation->nomor}}">{{$generation->program}} {{$generation->keterangan}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-3 col-xs-8">
                        <select id="tahun_lulus" class="form-control">
                            <option value="0">Tahun Lulus</option>
                            @foreach($tahun_lulus as $tahun)
                            <option value="{{$tahun->year_of_graduated}}">{{$tahun->year_of_graduated}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-3 col-xs-8">
                        <select id="schedule" class="form-control">
                            <option value="0">Semua Jadwal</option>
                            @foreach($schedules as $schedule)
                            <option value="{{$schedule->id}}">
                                {{ \Carbon\Carbon::parse($schedule->start_date)->format('d, M Y')}} -
                                {{ \Carbon\Carbon::parse($schedule->end_date)->format('d, M Y')}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    
                </div>
                <div class="row  p-3">
                    <div class="col-md-6">
                        <button class="btn btn-primary" onclick="filter()">Terapkan</button>
                        <button class="btn btn-default" id="save-grid">Simpan Susunan Layout Grafik</button>
                    </div>
                    <div class="col-md-6 text-right pull-right" id="download">
                        
                        <button class="btn btn-success" id="btn-download" onclick="download()">Download</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="chart-layout">
        @include('dashboard._chart')
    </div>
@stop

@section('scripts')
<script>
    function filter() {
        $('#chart-layout').fadeOut();
        var program_study = $('#program-study').val();
        var tahun_lulus = $('#tahun_lulus').val();
        var schedule = $('#schedule').val();
        var program = $('#program').val();
        $.get("{{url('dashboard/filter')}}", {
                program_study : program_study,
                tahun_lulus : tahun_lulus,
                schedule : schedule,
                program : program,
            },
            function(res){
                $('#chart-layout').fadeIn();
                $('#chart-layout').html(res);
            }
        );
    }

    function download() {
        var spinner = '<i class="fa fa fa-spinner fa-spin"></i>';
        $('#btn-download').html(spinner);
        var program_study = $('#program-study').val();
        var tahun_lulus = $('#tahun_lulus').val();
        var schedule = $('#schedule').val();
        var program = $('#program').val();
        $.get("{{url('dashboard/download')}}", {
                program_study : program_study,
                tahun_lulus : tahun_lulus,
                schedule : schedule,
                program : program,
            },
            function(res){
                var link = '<a href="'+res+'" class="btn btn-warning"><i class="fa fa-download"></i></a>';
                $('#btn-download').html('Download');
                $('#download').append(link);
            }
        );
    }
</script>
@stop