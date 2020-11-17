@extends('layout')

@section('content')
    @include('alumnus._bread-crumb')
    <div class="row">
        <!-- column -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-block">
                    <h4 class="card-title">Alumnus</h4>
                    <h6 class="card-subtitle">Alumnus of kuesioner</h6>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th >#</th>
                                    <th >Name</th>
                                    <th >NRP </th>
                                    <th >Email </th>
                                    <th >Graduated Date </th>
                                    <th >Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=0;?>
                                @foreach($list_alumnus as $alumnus)
                                <tr>
                                    <td>{{++$i}}</td>
                                    <td>{{ $alumnus->name}}</td>
                                    <td>{{ $alumnus->nrp}}</td>
                                    <td>{{ $alumnus->email}}</td>
                                    <td>{{ $alumnus->graduated_date}}</td>
                                    <td>
                                        <form action="{{url('alumnus/'.$alumnus->id)}}" method="post">
                                            {!! csrf_field() !!}
                                            <a class="btn btn-info" href="{{url('alumnus/'.$alumnus->id.'/edit')}}" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil"></i> </a>
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
