<style>
    a {
        color: blue;
        font-weight: 500
    }
</style>
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" >{{ \Carbon\Carbon::parse($schedule->start_date)->format('d, M Y')}} - {{ \Carbon\Carbon::parse($schedule->end_date)->format('d, M Y')}}</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <table class="table table-responsive">
                <thead>
                    <th style="width:25px">#</th>
                    <th>Lulusan</th>
                    <th>Jurusan</th>
                    <th>Program Studi</th>
                    <th>Download</th>
                </thead>
                <tbody>
                    @foreach($schedule->details as $row => $detail)
                    <?php $url = url('schedule/'.$schedule->id.'/'.$detail->tahun_lulus.'/'.$detail->program_study_id.'/'.$detail->program_id); ?>
                    <tr>
                        <td>{{++$row}}</td>                        
                        <td>{{$detail->tahun_lulus}}</td>                        
                        <td>{{$detail->programStudy->jurusan_lengkap}}</td>                        
                        <td>{{$detail->program->program . ' ' .$detail->program->keterangan}}</td>                        
                        <td><a href="{{$url}}">Unduh laporan yang belum entry</a></td>                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>

