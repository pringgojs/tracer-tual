@extends('layout')

@section('content')
    @include('participant._bread-crumb')
    <div class="row">
        <div class="col-lg-12">
            <div class="card p-20">
                <div class="card-header">
                    <h3 class="box-title m-b-0">Participant</h3>
                    <p class="text-muted m-b-30 font-13">Participant of Kuesiner </p>
                </div>
                <form class="form-material m-t-40" action="{{url('participant/'.$participant->id)}}" method="post">
                    {!! csrf_field() !!}
                    <input name="_method" type="hidden" value="PUT">

                    <div class="col-md-12">
                        <div class="form-participant">
                            <label class="control-label">Name</label>
                            <input type="text" id="name" required value="{{$participant->name}}" name="name" class="form-control" placeholder="">
                        </div>
                        <div class="form-nrp">
                            <label class="control-label">NRP</label>
                            <input type="text" id="nrp" required name="nrp" value="{{$participant->nrp}}" class="form-control" placeholder="">
                        </div>
                        <div class="form-email">
                            <label class="control-label">Email</label>
                            <input type="email" id="email" required name="email" value="{{$participant->email}}" class="form-control" placeholder="">
                        </div>
                        <div class="form-date">
                            <label class="control-label">Graduated Date</label>
                            <?php
                                $date = date_create($participant->graduated_date);
                            ?>
                            <input type="date" id="date" required name="graduated_date" value="{{ date_format($date, 'd-m-Y H:i:s')}}" class="form-control" placeholder="">
                        </div>
                        <div class="form-participant">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop