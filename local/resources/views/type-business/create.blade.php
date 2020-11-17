@extends('layout')

@section('content')
    @include('type-business._bread-crumb')
    <div class="row">
        <div class="col-lg-12">
            <div class="card p-20">
                <div class="card-header">
                    <h3 class="box-title m-b-0">Type of Business</h3>
                    <p class="text-muted m-b-30 font-13">Type of Business for company </p>
                </div>
                <form class="form-material m-t-40" action="{{url('type-business')}}" method="post">
                    {!! csrf_field() !!}
                    <div class="col-md-12">
                        <div class="form-type-business">
                            <label class="control-label">Name</label>
                            <input type="text" id="type-business" required name="name" class="form-control" placeholder="">
                        </div>
                        <div class="form-type-business">
                            <label class="control-label">Notes <br><small>used to provide a description of the type of business</small></label>
                            <input type="text" required name="notes" class="form-control" placeholder="">
                        </div>
                        <div class="form-type-business">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop