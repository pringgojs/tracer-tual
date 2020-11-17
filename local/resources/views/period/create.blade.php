@extends('layout')
@section('styles')
<link href="{{ asset('assets/plugins/ion-range-slider/css/ion.rangeSlider.css')}}" rel="stylesheet">
<link href="{{ asset('assets/plugins/ion-range-slider/css/ion.rangeSlider.skinModern.css')}}" rel="stylesheet">
@stop
@section('content')

    @include('period.bread-crumb')
    <div class="row">
        <div class="col-lg-12">
            <div class="card p-20">
                <div class="card-header">
                    <h3 class="box-title m-b-0">Periode Pengisian</h3>
                    <p class="text-muted m-b-30 font-13">Periode pengisian kuesioner </p>
                </div>
                <form class="form-material m-t-40" action="{{url('period')}}" method="post">
                    {!! csrf_field() !!}
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">Nama periode*</label>
                            <input type="text" required id="name" name="name" class="form-control" placeholder="">
                        </div>
                        <div class="alert alert-info">
                            <h4><i class="fa fa-warning"></i> Penting.</h4>
                            <p>Rentang waktu (range) digunakan untuk memberikan pertanyaan yang relevan dengan alumni berdasarkan tahun lulus.
                                Misalnya alumni tersebut lulus baru 1 tahun yang lalu, maka pada saat menjawab pertanyaan tracer study, pertanyaan yang tampil adalah pertanyaan yang sesuai periode ini. <br>
                                Dengan adanya periode memungkinkan untuk pertanyaan yang berbeda. Misalnya pertanyaan tahun pertama fokus di pekerjaan, pertanyaan tahun 5 dari kelulusan fokus di finansial.
                            </p>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Range dari tahun lulus (dalam bulan)*</label>
                            <input type="text" id="range" value="" name="range" />
                        </div>
                         <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('scripts')
<script>
    $(function () {
        $("#range").ionRangeSlider({
            hide_min_max: true,
            keyboard: true,
            min: 0,
            max: 100,
            from: 10,
            to: 60,
            type: 'double',
            step: 1,
            prefix: "mount ",
            grid: true
        });

    });
</script>
@stop