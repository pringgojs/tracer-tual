@extends('layout')

@section('content')
    @include('kuesioner._bread-crumb')
    <div class="row">
        <div class="col-lg-12">
            <div class="card p-20">
                <div class="card-header">
                    <h3 class="box-title m-b-0">Kuesioner</h3>
                    <p class="text-muted m-b-30 font-13"> Fill the blank form </p>
                </div>
                <form class="form-material m-t-40" action="{{url('user-survey/kuesioner')}}" method="post">
                    {!! csrf_field() !!}
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">Kuesioner</label>
                            <input type="text" id="kuesioner" name="kuesioner" class="form-control" placeholder="">
                        </div>
                        <div class="form-group">
                            <label>Periode</label>
                            <select class="form-control" name="periode_id" id="grup-kuesioner">
                                @foreach($list_periode as $periode)
                                <option value="{{$periode->id}}">{{$periode->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Nomer Urut</label>
                            <input type="text" id="order-number" value="" name="order_number" class="form-control" placeholder="">
                        </div>
                        @include('kuesioner.include._form-add-row')
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
    @include('kuesioner.include._script-add-row')
@stop