@extends('layout')

@section('content')

    @include('user.bread-crumb')
    <div class="row">
        <!-- column -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-block">
                    <h4 class="card-title">User</h4>
                    <h6 class="card-subtitle">Data user</h6>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=0;?>
                                @foreach($users as $user)
                                <tr>
                                    <td>{{++$i}}</td>
                                    <td><b style="font-weight:900">{{ $user->name}} </b>
                                        @if ($user->surveyor) 
                                            <br> <b style="font-weight:900"> Phone : </b> {{$user->surveyor->phone}}
                                            <br> <b style="font-weight:900"> Address : </b> {{$user->surveyor->address}}

                                        @endif
                                    </td>
                                    <td>{{ $user->email}}</td>
                                    <td>{{ $user->getRoles()->count() ? $user->getRoles()[0]->name: '-'}}</td>
                                    <td>
                                        <form action="{{url('user/'.$user->id)}}" method="post">
                                            {!! csrf_field() !!}
                                            <a class="btn btn-info" href="{{url('user/'.$user->id.'/edit')}}" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil"></i> </a>
                                            <input type="hidden" name="_method" value="delete" />
                                            @if (auth()->user()->id != $user->id)
                                            <button onclick="return confirmation();" class="btn btn-danger" data-toggle="tooltip" data-original-title="scri"> <i class="fa fa-close"></i> </button>
                                            @endif
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