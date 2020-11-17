@extends('layouts.frontend')

@section('content')

<div class="content-container">
    <div class="container">
        <div class="row justify-content-md-center">

            <div>
                <div class="row">
                    @if ($kuesioner)
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pull-left">
                        <a href="{{url('tracer-study/kuesioner/back')}}"><i class="fa fa-arrow-left"></i> Kembali</a>
                    </div>
                    @endif
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pull-right">
                        <div class="row">
                            <div class="col-xs-10  text-right">
                                <b>{{student()->nama}}</b> <br>
                                {{student()->nrp}} <br>
                                <a href="{{url('tracer-study/logout')}}">Keluar</a>
                            </div>
                            <div class="col-xs-2 text-info" style="border-left: 1px solid #eee">
                                <i class="fa fa-user-circle fa-3x"></i>
    
                            </div>
                        </div>
                    </div>
                </div>
                @if ($kuesioner)
                <div class="col-md-12 node-question">
                    <h1>Form Kuesioner</h1>
                    <h5>Jawablah pertanyaan dibawah ini sesuai dengan kondisi Anda</h5>
                    <hr>
                </div>
                <form id="form-identitas" method="post" action="{{url('tracer-study/kuesioner')}}">
                    {{ csrf_field() }}
                    <input type="hidden" name="kuesioner_id" value="{{$kuesioner->id}}">
                    <input type="hidden" name="periode_id" value="{{$periode->id}}">
                    <input type="hidden" name="schedule_id" value="{{$schedule->id}}">
                    <input type="hidden" name="alumni_id" value="{{$alumni->id}}">
                    
                    {{-- Render form --}}
                    @if($kuesioner->tipeA())
                        @include('frontend.tracer-study._form-A')

                    @elseif($kuesioner->tipeB())

                    @elseif($kuesioner->tipeC())
                        @include('frontend.tracer-study._form-C')

                    @elseif($kuesioner->tipeD())
                        @include('frontend.tracer-study._form-D')
                    
                    @elseif($kuesioner->tipeE())
                        @include('frontend.tracer-study._form-E')
                    @endif


                    <div class="col-md-12">
                        <br>
                        <button class="btn btn-primary pull-right">Simpan dan lanjutkan</button>
                    </div>
                </form>
                @else
                <br>
                <div class="col-md-12 alert alert-info node-question">
                    <p>Terimakasih telah melengkapi kuesioner tracer study. Data yang Anda masukkan akan sangat berguna bagi
                        pengembangan kampus.
                    </p>
                </div>
                @endif
            </div>
            {{-- <div>
                <div class="col-md-12 node-question">
                    <p>Terimakasih telah berpartisipasi dalam survey singkat</p>
                </div>
            </div> --}}
        </div>
    </div>
</div>

@endsection

@section('scripts')
    <script>
    var id_item_jawaban_lain = {{id_item_other_answer()}};
    function itemClick(id) {
        $('#radio-'+id).prop('checked', true);

        $('.node-answer').removeClass('activex');
        $('#node-answer-'+id).addClass('activex');

        if ($("#radio-"+id).is(':checked')) {
            if (id == id_item_jawaban_lain) {
                var html = '<input type="text" name="input" required id="input-jawaban-lain" placeholder="Masukkan jawaban lainnya" class="node-answer-input " id="">';
                $('#wrap-jawaban-lain').html(html);
            } else {
                $('#wrap-jawaban-lain').html("");
            }
        } else {
            if (id == id_item_jawaban_lain) {
                $('#wrap-jawaban-lain').html("");
            }
        }
    }

    function itemClickCheckbox(id) {
        if($("#checkbox-"+id).is(':checked')) {
            $('#node-answer-'+id).removeClass('activex');
            $('#checkbox-'+id).prop('checked', false);

            if (id == id_item_jawaban_lain) {
                var html = '<input type="text" name="input" required id="input-jawaban-lain" placeholder="Masukkan jawaban lainnya" class="node-answer-input " id="">';
                $('#wrap-jawaban-lain').html("");
            }
            
        } else {
            $('#checkbox-'+id).prop('checked', true);
            $('#node-answer-'+id).addClass('activex');
            if (id == id_item_jawaban_lain) {

                var html = '<input type="text" name="input" required id="input-jawaban-lain" placeholder="Masukkan jawaban lainnya" class="node-answer-input " id="">';
                $('#wrap-jawaban-lain').html(html);

            }
        }

    }
    </script>
@endsection

@section('styles')
    <style>
    .activex {
        background: #777777 !important;
        color: #ffffff !important;
    }
    </style>
@endsection