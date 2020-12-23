@extends('layout')
@section('content')

    @include('schedule.bread-crumb')
    <div class="row">
        <div class="col-lg-12">
            <div class="card p-20">
                <div class="card-header">
                    <h4 class="card-title">Jadwal Tracer Study</h4>
                    <h6 class="card-subtitle">Jadwal dilaksanakan tracer study</h6>
                </div>
                <form class="form-material m-t-40" action="{{url('schedule')}}" method="post">
                    {!! csrf_field() !!}
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">Tanggal</label>
                            <input type="button" class="btn btn-info" name="start_date" id="start-date" value="Pengisian tracer study dibuka">
                            <input type="button" class="btn btn-info" name="end_date" id="end-date" value="Pengisian tracer study ditutup">
                            <input type="hidden" id="inp-start-date" name="start_date">
                            <input type="hidden" id="inp-end-date" name="end_date">
                        </div>
                        
                        <div class="form-group">
                            <label class="control-label">Keterangan</label>
                            <input type="text" id="description" name="description" style="background-color:#eee" class="form-control p-3" placeholder="">
                        </div>
                        <div class="form-group">
                            <div class="form-group"  id="wrap-answer">
                                <label>Jurusan / Prodi yang akan di survey</label>
                                <table id="detail" class="table table-responsive table-border" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th width='450px'>Lulusan</th>
                                            <th width='450px'>Jurusan</th>
                                            <th width='450px'>Jenjang</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><div class="btn btn-success btn-sm btn-circle" onclick="addRow()" id="addRow"><i class="fa fa-plus"></i></div></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                         <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('scripts')
<script>
(function() {
        // load language from hash
        var hash = location.hash.replace('#', '');
        var locale = hash ? hash : 'en';
        moment.locale(locale);
        var x = new mdDateTimePicker.default({
            type: 'date',
            future: moment('2050-12-30')
        });
        var y = new mdDateTimePicker.default({
            type: 'date',
            future: moment('2050-12-30')
        });
        document.getElementById('start-date').addEventListener('click', function() {
            x.toggle();
        });
        x.trigger = document.getElementById('start-date');
        document.getElementById('start-date').addEventListener('onOk', function() {
            this.value = x.time.format('DD-MM-YYYY');
            $('#inp-start-date').val(x.time.format('YYYY-MM-DD'));
        });

        document.getElementById('end-date').addEventListener('click', function() {
            y.toggle();
        });
        y.trigger = document.getElementById('end-date');
        document.getElementById('end-date').addEventListener('onOk', function() {
            this.value = y.time.format('DD-MM-YYYY');
            $('#inp-end-date').val(y.time.format('YYYY-MM-DD'));
        });
    }).call(this);

</script>

<script>
    var t = $('#detail').DataTable({
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
            '<select name="tahun_lulus[]" class="form-control">'+
                @foreach ($tahun_lulus as $tahun)
                    '<option value="{{$tahun->tahun_lulus}}">{{$tahun->tahun_lulus}}</option>'+
                @endforeach
            '</select>',
            '<select name="program_studies[]" class="form-control">'+
                @foreach ($study_programs as $program)
                    '<option value="{{$program->nomor}}">{{$program->jurusan_lengkap}}</option>'+
                @endforeach
            '</select>',
            '<select name="programs[]" class="form-control">'+
                @foreach ($programs as $program)
                    '<option value="{{$program->nomor}}">{{$program->program}} {{$program->keterangan}}</option>'+
                @endforeach
            '</select>',
        ] ).draw( false );
    }
    
    $('#detail tbody').on('click', '.remove-row', function () {
        t.row($(this).parents('tr')).remove().draw();
    });
</script>
@stop