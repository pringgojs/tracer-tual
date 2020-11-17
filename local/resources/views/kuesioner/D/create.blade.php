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
                <form class="form-material m-t-40" action="{{url('kuesioner/D')}}" method="post">
                    {!! csrf_field() !!}
                    <div class="col-md-12">
                        @include('kuesioner.include._form-name')
                        {{-- @include('kuesioner.include._form-group') --}}
                        @include('kuesioner.include._form-status-order')
                        <div class="form-group"  id="wrap-answer">
                            <label>Pertanyaan detail</label>
                            <table id="answer-d" class="table table-responsive table-border" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th width='450px'>Pertanyaan</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <td></td>
                                    <td><div class="btn btn-success btn-sm btn-circle" onclick="addRowD()" id="addRow"><i class="fa fa-plus"></i></div></td>
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
                                        <th width='450px'>  </th>
                                    </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <td></td>
                                    <td><div class="btn btn-success btn-sm btn-circle" onclick="addRowItem()" id="addRowItem"><i class="fa fa-plus"></i></div></td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        @include('kuesioner.include._form-conditional-logic')
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
@section('scripts')
    @include('kuesioner.include._script-load')

    <script>
    
    var tD = $('#answer-d').DataTable({
        bSort: false,
        bPaginate: false,
        bInfo: false,
        bFilter: false,
        bScrollCollapse: false
    });

    var tItem = $('#answer-item').DataTable({
        bSort: false,
        bPaginate: false,
        bInfo: false,
        bFilter: false,
        bScrollCollapse: false
    });

    function addRowD() {
        tD.row.add( [
            '<a href="javascript:void(0)" class="remove-row"><i class="fa fa-remove"></i></a>',
            '<input type="text" name="questions[]"  class="form-control" /><input type="hidden" name="question_id[]" class="form-control" />',
        ] ).draw( false );
    }

    function addRowItem() {
        tItem.row.add( [
            '<a href="javascript:void(0)" class="remove-row-item"><i class="fa fa-remove"></i></a>',
            '<input type="text" name="notes_answer[]"  class="form-control" /><input type="hidden" name="question_item_id[]" class="form-control" />',
            '<input type="text" name="value[]"  class="form-control" />',
        ] ).draw( false );
    }
    
    $('#answer-d tbody').on('click', '.remove-row', function () {
        tD.row($(this).parents('tr')).remove().draw();
    });

    $('#answer-item tbody').on('click', '.remove-row-item', function () {
        tItem.row($(this).parents('tr')).remove().draw();
    });

    </script>
@stop
