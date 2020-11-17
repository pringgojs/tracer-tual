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
                    <h3 class="box-title m-b-0">Periode user survey</h3>
                    <p class="text-muted m-b-30 font-13"></p>
                </div>
                <form class="form-material m-t-40" action="{{url('user-survey/periode/'.$periode->id)}}" method="post">
                    {!! csrf_field() !!}
                    <input name="_method" type="hidden" value="PUT">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">Name</label>
                            <input type="text" value="{{$periode->name}}" required id="name" name="name" class="form-control" placeholder="">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Status Periode</label>
                            <select name="status" class="form-control" id="">
                                <option value="1" @if($periode->status == 1) selected @endif>Aktif</option>
                                <option value="0" @if($periode->status == 0) selected @endif>Non-aktif</option>
                            </select>
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
