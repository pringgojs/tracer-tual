@extends('layouts.frontend')

@section('content')
            
    <div class="content-container">
        <div class="container">
            <div class="row">
                <a href="{{url('tracer-study/login')}}">
                    <div class="col-md-12 col-xs-12 bg-info text-primary" style="padding:20px;">
                        <div class="col-md-3">
                            <i class="fa fa-file fa-4x text-primary"></i>
                        </div>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3 style="color:#000">Tracer Study</h3>
                                    <p style="color:#000">Aplikasi Tracer Study</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                {{-- <a href="{{url('alumni')}}">
                    <div class="col-md-6 col-xs-12 bg-info text-primary" style="padding:20px;">
                        <div class="col-md-3">
                            <i class="fa fa-address-book fa-4x text-primary"></i>
                        </div>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3 style="color:#000">User Survey </h3>
                                    <p style="color:#000">Kuesioner untuk user survey</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a> --}}
            </div>
            
        </div>
    </div>
@endsection