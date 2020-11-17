@extends('layouts.frontend')

@section('styles')
<style>
    @media (min-width: 980px) {
        .container {
            width: 980px;
            max-width: 100%;
        }

    }
    @media (min-width: 980px) {
        .container {
            display: table;
            min-width: 980px;
        }
    }
    body {
        background-color: #f3f7fa;
    }

    input[type="text"] {
        border-radius: 0px;
    }

    .btn {
        border-radius: 0px;
    }
    .bg-w {
        background-color: #ffffff;
    }
</style>
@endsection

@section('content')
    <div class="content-container">
        <div class="container jumbotron bg-w box-shadow-code">
            <div class="col-md-6">
                <div class="alert alert-info" role="alert">
                    <h3><i class="fa fa-info-circle"></i> Informasi</h3>
                    <br>
                    <ul>
                        <li>Alumni yang bisa mengakases adalah alumni yang telah didaftarkan oleh pihak kampus</li>
                        <li>Apabila anda lupa Nomer Induk Mahasiswa (NIM) hubungi pihak kampus untuk mengaktifkan akun anda</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6" style="padding: 30px">
                <form class="form-horizontal form-material" id="loginform" method="post" action="{{url('tracer-study/login')}}">
                    {{ csrf_field() }}
                    <h3>Login</h3> <br>
                    <div class="form">
                        <div class="form-group">
                            <label for="form2">Nomer Induk Mahasiswa (NIM)</label>
                            <input type="text" id="form2" value="{{old('nrp')}}" name="nrp" required class="form-control input-lg">
                            @if(session('error'))<p style="color:red;font-size:14px; padding-top:5px">{{session('error')}}</p>@endif
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-primary">Masuk</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <div class="container footer">
        <div class="col-lg-6 col-md-6 ">
            <span>© {{date('Y')}}
                <b>Politeknik Perikanan Negeri Tual </b> &nbsp; &nbsp;
            </span>
        </div>
        <div class="col-lg-6 col-md-6 ">
            <span class="pull-right">
                {{-- <i class="fa fa-phone-square" aria-hidden="true"></i> <b>Call center : </b> 62 31 594 7280 --}}
            </span>
        </div>
    </div>
@endsection