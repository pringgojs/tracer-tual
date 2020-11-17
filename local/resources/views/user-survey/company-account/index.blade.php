@extends('layout')

@section('content')

    @include('user-survey.company-account.bread-crumb')
    <div class="row">
        <!-- column -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-block">
                    <h4 class="card-title">Akun Perusahaan</h4>
                    <h6 class="card-subtitle">Daftar akun perusahaan untuk mengisi user survey</h6>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Username</th>
                                    <th>Password</th>
                                    <th>Status</th>
                                    <th>Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=0;?>
                                @foreach($list_company_account as $company_account)
                                <tr>
                                    <td>{{++$i}}</td>
                                    <td>{{ $company_account->username}}</td>
                                    <td>{{ $company_account->password}}</td>
                                    <td>{{ $company_account->status_account ? 'sudah dipakai' : 'belum dipakai'}}</td>
                                    <td>
                                        <form action="{{url('user-survey/company-account/'.$company_account->id)}}" method="post">
                                            {!! csrf_field() !!}
                                            <a class="btn btn-info" href="{{url('user-survey/company-account/'.$company_account->id.'/edit')}}" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil"></i> </a>
                                            <input type="hidden" name="_method" value="delete" />
                                            <button  onclick="return confirmation();" class="btn btn-danger" data-toggle="tooltip" data-original-title="scri"> <i class="fa fa-close"></i> </button>
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