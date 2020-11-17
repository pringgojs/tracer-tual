@extends('layout')

@section('content')
    @include('alumnus._bread-crumb')
    <div class="row">
        <div class="col-lg-12">
            <div class="card p-20">
                <div class="card-header">
                    <h3 class="box-title m-b-0">Alumnus</h3>
                    <p class="text-muted m-b-30 font-13">Alumnus of Kuesiner </p>
                </div>
                <form class="form-material m-t-40" action="{{url('alumnus/'.$alumnus->id)}}" method="post">
                    {!! csrf_field() !!}
                    <input name="_method" type="hidden" value="PUT">

                    <div class="col-md-12">
                        <div class="form-alumnus">
                            <label class="control-label">Name</label>
                            <input type="text" id="name" required value="{{$alumnus->name}}" name="name" class="form-control" placeholder="">
                        </div>
                        <div class="form-nrp">
                            <label class="control-label">NRP</label>
                            <input type="text" id="nrp" required name="nrp" value="{{$alumnus->nrp}}" class="form-control" placeholder="">
                        </div>
                        <div class="form-email">
                            <label class="control-label">Email</label>
                            <input type="email" id="email" required name="email" value="{{$alumnus->email}}" class="form-control" placeholder="">
                        </div>
                        <div class="form-date">
                            <label class="control-label">Graduated Date</label>
                            <?php
                                $date = date_create($alumnus->graduated_date);
                            ?>
                            <input type="date" id="date" required name="graduated_date" value="{{ date_format($date, 'd-m-Y H:i:s')}}" class="form-control" placeholder="">
                        </div>
                        <div class="form-alumnus">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop