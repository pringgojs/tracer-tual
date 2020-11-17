@extends('layout')

@section('content')
    @include('kuesioner._bread-crumb')
    <div class="row">
        <div class="col-lg-12">
            <div class="card p-20">
                <div class="card-header">
                    <h3 class="box-title m-b-0">Kuesioner</h3>
                    <p class="text-muted m-b-30 font-13"> Fill the blank form </p>
                </div>
                <form class="form-material m-t-40" action="{{url('kuesioner')}}" method="post">
                    {!! csrf_field() !!}
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">Kuesioner</label>
                            <input type="text" id="kuesioner" name="kuesioner" class="form-control" placeholder="">
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-8">
                                    <label>Grup Kuesioner</label>
                                    <select class="form-control" name="group" id="grup-kuesioner">
                                    @foreach($list_group as $group)
                                    <option value="{{$group->id}}">{{$group->name}}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <div class="btn btn-primary btn-sm btn-circle" id="add-group" onclick="resetModal()" data-toggle="modal" data-target="#modal-group" data-whatever="@mdo"><i class="fa fa-plus"></i></div>
                                     
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Jenis Jawaban</label>
                            <div class="form-check">
                                <label class="custom-control custom-radio">
                                    <input name="jenis" onclick="jenisKuesioner(0)" id="rd-easy" type="radio" checked="" class="custom-control-input">
                                    <span class="custom-control-indicator"></span>
                                    <span class="custom-control-description">Uraian</span>
                                </label>
                                <label class="custom-control custom-radio">
                                    <input name="jenis" onclick="jenisKuesioner(1)" id="rd-multiple" type="radio" class="custom-control-input">
                                    <span class="custom-control-indicator"></span>
                                    <span class="custom-control-description">Pilihan Ganda</span>
                                </label>
                                <label class="custom-control custom-radio">
                                    <input name="jenis" onclick="jenisKuesioner(1)" id="rd-multiple" type="radio" class="custom-control-input">
                                    <span class="custom-control-indicator"></span>
                                    <span class="custom-control-description">Double Pilihan Ganda</span>
                                </label>
                            </div>
                            <br>
                            <div class="form-group"  id="wrap-jawaban" style="display:none; ">
                                <label>Masukkan jawaban untuk pertanyaan tersebut</label>
                                <table id="jawaban" class="table table-responsive table-border" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th width='450px'>Keterangan</th>
                                            <th width='250px'>Bobot Nilai</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td><div class="btn btn-success btn-sm btn-circle" onclick="addRow()" id="addRow"><i class="fa fa-plus"></i></div></td>
                                    </tr>
                                    </tfoot>
                                </table>
                                
                            </div>
                            <div class="form-group">
                            <br>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
     @include('kuesioner._create-group')
    
@stop
@section('scripts')
    <script>
    function jenisKuesioner(value) {
        if (value == 1) {
            $("#wrap-jawaban").show(0);
        }

        if (value == 0) {
            $("#wrap-jawaban").hide(0);
        }
    }

    var t = $('#jawaban').DataTable({
        bSort: false,
        bPaginate: false,
        bInfo: false,
        bFilter: false,
        bScrollCollapse: false
    });

    var counter = 1;

    function addRow() {
        t.row.add( [
            '<a href="javascript:void(0)" class="remove-row"><i class="fa fa-remove"></i></a>',
            '<input type="text" name="jawaban_keterangan[]"  class="form-control" />',
            '<input type="text" name="jawaban_nilai[]"  class="form-control" />',
        ] ).draw( false );
    }
    
    $('#jawaban tbody').on('click', '.remove-row', function () {
        t.row($(this).parents('tr')).remove().draw();
    });
    </script>
@stop
