@extends('layouts.frontend')

@section('content')

<div class="content-container">
    <div class="container">
        <div class="row justify-content-md-center">

            <div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pull-right">
                        <div class="row">
                            <div class="col-xs-10  text-right">
                                <b>{{$alumni->name}}</b> <br>
                                {{$alumni->nrp}} <br>
                            </div>
                            <div class="col-xs-2 text-info" style="border-left: 1px solid #eee">
                                <i class="fa fa-user-circle fa-3x"></i>
    
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 node-question">
                    <h1>Jawaban Dari Tracer Study</h1>
                    <h5>Lihat jawaban alumni</h5>
                    <hr>
                </div>
                <form id="form-identitas" method="post" action="{{url('tracer-study/kuesioner')}}">

                    @foreach ($alumni->alumniAnswer as $row => $alumni_answer)
                    <?php 
                        $kuesioner = $alumni_answer->kuesioner;
                        $kuesioner->kuesioner = ++$row.') '.$kuesioner->kuesioner;
                     ?>
                     
                    {{-- Render form --}}
                    @if($kuesioner->tipeA())
                        @include('frontend.tracer-study._answer-form-A')

                    @elseif($kuesioner->tipeB())

                    @elseif($kuesioner->tipeC())
                        @include('frontend.tracer-study._answer-form-C')

                    @elseif($kuesioner->tipeD())
                        @include('frontend.tracer-study._answer-form-D')
                    
                    @elseif($kuesioner->tipeE())
                        @include('frontend.tracer-study._answer-form-E')
                    @endif

                    @endforeach



                    
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
    <script>
    function itemClick(id) {
        $('#radio-'+id).prop('checked', true);

        $('.node-answer').removeClass('activex');
        $('#node-answer-'+id).addClass('activex');

        if ($("#radio-"+id).is(':checked')) {
            if (id == 1000) {
                $('#input-jawaban-lain').removeClass('hidden');
            } else {
                $('#input-jawaban-lain').addClass('hidden');
            }
        } else {
            if (id == 1000) {
                $('#input-jawaban-lain').addClass('hidden');
            }
        }
    }

    function itemClickCheckbox(id) {
        if($("#checkbox-"+id).is(':checked')) {
            $('#node-answer-'+id).removeClass('activex');
            $('#checkbox-'+id).prop('checked', false);

            if (id == 1000) {
                var html = '<input type="text" name="input" required id="input-jawaban-lain" placeholder="Masukkan jawaban lainnya" class="node-answer-input " id="">';
                $('#wrap-jawaban-lain').html("");
            }
            
        } else {
            $('#checkbox-'+id).prop('checked', true);
            $('#node-answer-'+id).addClass('activex');
            if (id == 1000) {

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