@extends('layout')

@section('content')
    @include('kuesioner._bread-crumb')
    <div class="row">
        <div class="col-lg-12">
            <div class="card p-20">
                <div class="card-header">
                    <h3 class="box-title m-b-0">Kuesioner</h3>
                    <p class="text-muted m-b-30 font-13"> Pertanyaan dengan jawaban pilihan ganda dan nilai </p>
                </div>
                <form class="form-material m-t-40" action="{{url('kuesioner/D/'.$kuesioner->id)}}" method="post">
                    {!! csrf_field() !!}                    
                    <input name="_method" type="hidden" value="PUT">

                    <div class="col-md-12">
                        @include('kuesioner.include._edit-name')
                        {{-- @include('kuesioner.include._edit-group') --}}
                        @include('kuesioner.include._edit-status-order')
                        <div class="form-group"  id="wrap-answer">
                            <label>Pertanyaan detail</label>
                            <table id="answer" class="table table-responsive table-border" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th width='450px'>Pertanyaan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($kuesioner->multipleChoice as $multiple_choice)
                                    <tr id="tr-multi-item-{{$multiple_choice->id}}">
                                        <td><a href="javascript:void(0)" class="remove-row-{{$multiple_choice->id}}" onclick="removeMultipleItem({{$multiple_choice->id}})"><i class="fa fa-remove"></i></a></td>
                                        <td>
                                            <input type="hidden" name="item_id[]" value="{{$multiple_choice->id}}">
                                            <input type="text" value="{{$multiple_choice->notes}}" name="answer[]"  class="form-control" />
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td></td>
                                    <td><div class="btn btn-success btn-sm btn-circle" onclick="addRow()" id="addRow"><i class="fa fa-plus"></i></div></td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="form-group"  id="wrap-answer">
                            <label>Jawaban dan Nilai dari pertanyaan detail</label>
                            <table id="answer-item" class="table table-responsive table-border" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th width='450px'>Jawaban</th>
                                        <th width='450px'>Nilai (bobot) jawaban</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($kuesioner->multipleChoiceItem as $multiple_choice)
                                    <tr id="tr-multi-item-value-{{$multiple_choice->id}}">
                                        <input type="hidden" name="answer_item_id[]" value="{{$multiple_choice->id}}">

                                        <td><a href="javascript:void(0)" class="remove-row-item-{{$multiple_choice->id}}" onclick="removeMultipleItemValue({{$multiple_choice->id}})"><i class="fa fa-remove"></i></a></td>
                                        <td>
                                            <input type="text" value="{{$multiple_choice->notes}}" name="notes_answer[]"  class="form-control" />
                                        </td>
                                        <td>
                                            <input type="text" value="{{$multiple_choice->value}}" name="value[]"  class="form-control" />
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td></td>
                                    <td><div class="btn btn-success btn-sm btn-circle" onclick="addRowItem()" id="addRowItem"><i class="fa fa-plus"></i></div></td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        @include('kuesioner.include._edit-conditional-logic')
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
@section('scripts')
    @include('kuesioner.include._script-load')
    <script>
    

    var tItem = $('#answer-item').DataTable({
        bSort: false,
        bPaginate: false,
        bInfo: false,
        bFilter: false,
        bScrollCollapse: false
    });

    function addRowItem() {
        tItem.row.add( [
            '<a href="javascript:void(0)" class="remove-row-item"><i class="fa fa-remove"></i></a>',
            '<input type="text" name="notes_answer[]"  class="form-control" />',
            '<input type="text" name="value[]"  class="form-control" /><input type="hidden" name="answer_item_id[]"  class="form-control" />',
        ] ).draw( false );
    }
    
    $('#answer-item tbody').on('click', '.remove-row-item', function () {
        tItem.row($(this).parents('tr')).remove().draw();
    });

    function removeMultipleItemValue(id) {
        var t = confirm('Anda yakin ingin menghapus permanen data ini ? data yang sudah dihapus tidak dapat dikembalikan');
        if (!t) return;
        $.ajax({
            url: '{{url("kuesioner/remove-item-value")}}/'+id,
            success: function (res) {
                $('#tr-multi-item-value-'+id).hide();
                notification('Berhasil dihapus');
            },
            error: function (res) {
                notification('Gagal dihapus');
            }
        })
    }
    </script>
@stop
