@extends('layout')

@section('content')
    @include('kuesioner._bread-crumb')
    <div class="row">
        <div class="col-lg-12">
            <div class="card p-20">
                <div class="card-header">
                    <h3 class="box-title m-b-0">Kuesioner</h3>
                    <p class="text-muted m-b-30 font-13">Pertanyaan dengan jawaban isian</p>
                </div>
                <form class="form-material m-t-40" action="{{url('kuesioner/A')}}" method="post">
                    {!! csrf_field() !!}
                    <div class="col-md-12">
                        @include('kuesioner.include._form-name')
                        {{-- @include('kuesioner.include._form-group') --}}
                        @include('kuesioner.include._form-type')
                        @include('kuesioner.include._form-required')
                        @include('kuesioner.include._form-status-order')
                        @include('kuesioner.include._form-conditional-logic')
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section("scripts")
    @include('kuesioner.include._script-load')
@stop