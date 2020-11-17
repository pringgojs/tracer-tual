@extends('layout')

@section('content')
    @include('job._bread-crumb')
    <div class="row">
        <!-- column -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-block">
                    <h4 class="card-title">Job</h4>
                    <h6 class="card-subtitle">Job of kuesioner</h6>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th >#</th>
                                    <th >Name</th>
                                    <th >Notes </th>
                                    <th >Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=0;?>
                                @foreach($jobs as $job)
                                <tr>
                                    <td>{{++$i}}</td>
                                    <td>{{ $job->name}}</td>
                                    <td>{{ $job->notes}}</td>
                                    <td>
                                        <form action="{{url('job/'.$job->id)}}" method="post">
                                            {!! csrf_field() !!}
                                            <a class="btn btn-info" href="{{url('job/'.$job->id.'/edit')}}" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil"></i> </a>
                                            <input type="hidden" name="_method" value="delete" />
                                            <button class="btn btn-danger" data-toggle="tooltip" data-original-title="scri"> <i class="fa fa-close"></i> </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
