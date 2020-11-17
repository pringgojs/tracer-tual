@extends('layout')

@section('content')
    @include('job._bread-crumb')
    <div class="row">
        <div class="col-lg-12">
            <div class="card p-20">
                <div class="card-header">
                    <h3 class="box-title m-b-0">Job</h3>
                    <p class="text-muted m-b-30 font-13">Job of Kuesiner </p>
                </div>
                <form class="form-material m-t-40" action="{{url('job/'.$job->id)}}" method="post">
                    {!! csrf_field() !!}
                    <input name="_method" type="hidden" value="PUT">

                    <div class="col-md-12">
                        <div class="form-job">
                            <label class="control-label">Name</label>
                            <input type="text" id="name" required value="{{$job->name}}" name="name" class="form-control" placeholder="">
                        </div>
                        <div class="form-job">
                            <label class="control-label">Description <br><small>used to provide a description of the job</small></label>
                            <input type="text" id="desc" value="{{$job->notes}}" required name="notes" class="form-control" placeholder="">
                        </div>
                        <div class="form-job">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop