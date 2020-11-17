@extends('layouts.frontend')

@section('content')

<div class="content-container">
    <div class="container">
        <div class="row justify-content-md-center">

            <div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pull-right">
                        <div class="row">
                            <div class="col-xs-10  text-right">
                                <b>{{student()->nama}}</b> <br>
                                {{student()->nrp}} <br>
                                <a href="{{url('tracer-study/logout')}}">Keluar</a>
                            </div>
                            <div class="col-xs-2 text-info"  style="border-left: 1px solid #eee">
                                <i class="fa fa-user-circle fa-3x"></i>
    
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 node-question">
                    <h1>Identitas Diri</h1>
                    <h5>Lengkapi form dibawah ini</h5>
                </div>
                <form id="form-identitas" method="post" action="{{url('tracer-study/identitas-diri')}}">
                    {{ csrf_field() }}
                    <div class="col-md-12">
                        {{-- <p  class="bg-danger" style="padding:5px; border-radius:3px">
                            <b>Harap perbaiki kesalahan berikut:</b>
                            <ul>
                                <li v-for="error in errors"> error</li>
                            </ul>
                        </p> --}}
                        <p>Nomer Mahasiswa</p>
                        <input 
                            class="node-answer-input" type="number" name="nrp" required
                            readonly disabled value="{{student()->nrp}}" placeholder="NRP">
                            <br>
                        <p>Kode Perguruan Tinggi</p>
                        <input 
                            class="node-answer-input" type="text" name="kode_pt" required
                            readonly disabled value="005026" placeholder=""> <br>
                        <p>Tahun Lulus</p>
                        <input 
                            class="node-answer-input" type="text" name="tahun_lulus" required
                            readonly disabled value="{{student()->tahun_lulus}}" placeholder=""> <br>
                        
                        <p>Kode Prodi</p>
                        <input 
                            class="node-answer-input" type="text" name="kode_prodi" required
                            readonly disabled value="{{student()->classes->programx->kode_epsbed}}" placeholder=""> <br>
                        <p>Nama</p>
                        <input 
                            class="node-answer-input" type="text" name="nama" required
                            readonly disabled value="{{student()->nama}}" placeholder=""> <br>
                        
                        <p>Nomer HP</p>
                        <input 
                            class="node-answer-input"
                            type="number"
                            name="hp"
                            required
                            value="{{$alumni ? $alumni->phone : ''}}"
                            placeholder="Nomer HP"> <br>
                        <p>Alamat Email</p>
                        <input 
                            class="node-answer-input"
                            type="email"
                            name="email"
                            required
                            value="{{$alumni ? $alumni->email : ''}}"

                            placeholder="Email Anda">
                        
                        <br>
                        <button class="btn btn-primary pull-right">Simpan dan lanjutkan</button>
                    </div>
                </form>
            </div>
            {{-- <div>
                <div class="col-md-12 node-question">
                    <p>Terimakasih telah berpartisipasi dalam survey singkat</p>
                </div>
            </div> --}}
        </div>
    </div>
</div>

@endsection