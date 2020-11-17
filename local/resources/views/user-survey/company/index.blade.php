@extends('layout')

@section('content')
    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor">Perusahaan</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">User Survey</a></li>
                <li class="breadcrumb-item active">Akun Perusahaan</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <!-- column -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-block">
                    <h4 class="card-title">Perusahaan</h4>
                    <h6 class="card-subtitle">Daftar perusahaan user survey</h6>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Perusahaan</th>
                                    <th>Alamat Perusahaan</th>
                                    <th>Telp Perusahaan</th>
                                    <th>Nama Volunter</th>
                                    <th>Jabatan Volunter</th>
                                    <th>Periode isi</th>
                                    <th>Dibuat oleh</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=0;?>
                                @foreach($list_company as $company)
                                <tr>
                                    <td>{{++$i}}</td>
                                    <td>{{ $company->company_name}}</td>
                                    <td>{{ $company->company_address}}</td>
                                    <td>{{ $company->company_phone}}</td>
                                    <td>{{ $company->volunter_name}}</td>
                                    <td>{{ $company->volunter_position}}</td>
                                    <td>{{ $company->periode}}</td>
                                    <td>{{ \App\User::find($company->created_by)->name}}</td>
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