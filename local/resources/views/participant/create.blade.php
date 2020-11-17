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
                <form class="form-material m-t-40" action="{{url('participant')}}" method="post">
                    {!! csrf_field() !!}
                    <div class="col-md-12">
                        <div class="form-participant">
                            <label class="control-label">Name</label>
                            <input type="text" id="participant" required name="name" class="form-control" placeholder="">
                        </div>
                        <div class="form-nrp">
                            <label class="control-label">NRP</label>
                            <input type="text" id="nrp" required name="nrp" class="form-control" placeholder="">
                        </div>
                        <div class="form-email">
                            <label class="control-label">Email</label>
                            <input type="email" id="email" required name="email" class="form-control" placeholder="">
                        </div>
                        <div class="form-date">
                            <label class="control-label">Graduated Date</label>
                            <input type="date" id="date" required name="graduated_date" class="form-control" placeholder="">
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