@extends('layout')

@section('content')
    @include('alumnus._bread-crumb')
    <div class="row">
        <!-- column -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-block">
                    <h4 class="card-title">ALumni</h4>
                    <h6 class="card-subtitle">Alumni 1980 - 2000</h6>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th >#</th>
                                    <th >Name</th>
                                    <th >Program Study</th>
                                    <th >Address</th>
                                    <th >Telp </th>
                                    <th >Working </th>
                                    <th >Position </th>
                                    <th >Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=0;?>
                                @foreach($list_alumni as $alumni)
                                <tr>
                                    <td>{{++$i}}</td>
                                    <td>{{ $alumni->name}}</td>
                                    <td>{{ $alumni->program_study}}</td>
                                    <td>{{ $alumni->address}}</td>
                                    <td>{{ $alumni->phone}}</td>
                                    <td>{{ $alumni->working}}</td>
                                    <td>{{ $alumni->position}}</td>
                                    <td>
                                        <form action="{{url('alumni-lawas/'.$alumni->id)}}" method="post">
                                            {!! csrf_field() !!}
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
