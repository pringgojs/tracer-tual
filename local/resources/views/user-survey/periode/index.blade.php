@extends('layout')

@section('content')

    @include('user-survey.periode.bread-crumb')
    <div class="row">
        <!-- column -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-block">
                    <h4 class="card-title">Periode</h4>
                    <h6 class="card-subtitle">Periode user survey</h6>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Status</th>
                                    <th>Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=0;?>
                                @foreach($list_periode as $periode)
                                <tr>
                                    <td>{{++$i}}</td>
                                    <td>{{ $periode->name}}</td>
                                    <td>{{ $periode->status ? 'aktif' : 'non-aktif'}}</td>
                                    <td>
                                        <form action="{{url('user-survey/periode/'.$periode->id)}}" method="post">
                                            {!! csrf_field() !!}
                                            <a class="btn btn-info" href="{{url('user-survey/periode/'.$periode->id.'/edit')}}" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil"></i> </a>
                                            <input type="hidden" name="_method" value="delete" />
                                            <button onclick="return confirmation();" class="btn btn-danger" data-toggle="tooltip" data-original-title="scri"> <i class="fa fa-close"></i> </button>
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