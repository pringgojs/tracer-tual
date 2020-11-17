@extends('layout')

@section('content')
    @include('period.bread-crumb')

    <div class="alert alert-info">
        <h3>Petunjuk mengurutkan kuesioner</h3>
        <p>
            1. Kuesioner perlu diurutkan agar pertanyaan yang muncul di halaman kuesioner lebih rapi dan runtut.  <br>
            2. Untuk pertanyaan yang mempunyai logic, pastikan urutannya setelah pertanyaan parent (sesuai logic nya). <font class="text-danger">JANGAN DISUSUN SEBELUM PERTANYAAN PARENT !!</font>  <br>
            3. Cara menyusun ulang pertanyaan adalah dengan menekan mouse lama (klik + drag) pada baris tabel yang akan dipindah. <br>
            4. Secara otomatis baris pertanyaan yang pindah, sudah disimpan diserver. Anda tidak perlu penyimpan ulang agar sususan tersimpan
        </p>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card p-20">
                <div class="card-header">
                    <h3 class="box-title m-b-0">Susun ulang urutan kuesioner</h3>
                    <p class="text-muted m-b-30 font-13"> daftar kuesioner pada periode {{$periode->name}} </p>
                </div>
                <div class="col-row">
                    
                </div>
                <div class="table-responsive" id="data-kuesioner"> 
                    @include('period._data-kuesioner')
                </div>
                <div class="pull-right">
                </div>
            </div>
        </div>
    </div>
    <div class="modal hide fade" id="modal-detail" tabindex="-1" role="dialog"></div>
    
@stop

@section('scripts')
<script>
    function showKuesioner(url) {
        $.ajax({
            url: url,
            success: function(result){
                $("#modal-detail").html(result);
                $('#modal-detail').modal('show');
            }, error: function(result){
                console.log(result);
                alert("Failed something went wrong");
            }
        });
    }

    function loadPage(url) {
        $.ajax({
            url:url,
            success: function(res) {
                $('#data-kuesioner').html(res);
            },
            error: function(res) {
                console.log(res);
            }
        })
    }

</script>
@stop