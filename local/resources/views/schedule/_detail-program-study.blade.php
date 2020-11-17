<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" >{{ \Carbon\Carbon::parse($schedule->start_date)->format('d, M Y')}} - {{ \Carbon\Carbon::parse($schedule->end_date)->format('d, M Y')}}</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <ul class="list-group">
                <?php
                $program_studies = explode(',', $schedule->program);
                foreach ($program_studies as $program_study) {
                    $program_study = \App\Models\Program::find($program_study);
                    echo '<li class="list-group-item">'.$program_study->program .' '.$program_study->keterangan.'</li>';
                }
                ?>
            </ul>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>

