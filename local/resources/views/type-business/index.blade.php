@extends('layout')

@section('content')
    @include('type-business._bread-crumb')
    <div class="row">
        <!-- column -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-block">
                    <h3 class="box-title m-b-0">Type of Business</h3>
                    <p class="text-muted m-b-30 font-13">Type of Business for company </p>
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
                                @foreach($types as $type)
                                <tr>
                                    <td>{{++$i}}</td>
                                    <td>{{ $type->name}}</td>
                                    <td>{{ $type->notes}}</td>
                                    <td>
                                        <form action="{{url('type-business/'.$type->id)}}" method="post">
                                            {!! csrf_field() !!}
                                            <a class="btn btn-info" href="{{url('type-business/'.$type->id.'/edit')}}" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil"></i> </a>
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
