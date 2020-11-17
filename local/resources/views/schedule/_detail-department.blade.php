<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" >Departement</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <ul class="list-group">
                <?php
                $program_studies = explode(',', $schedule->program_study);
                foreach ($program_studies as $program_study) {
                    $program_study = \App\Models\ProgramStudy::find($program_study);
                    echo '<li class="list-group-item">'.$program_study->jurusan_lengkap.'</li>';
                }
                ?>
            </ul>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>

