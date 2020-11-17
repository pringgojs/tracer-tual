<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" >{{ \Carbon\Carbon::parse($schedule->start_date)->format('d, M Y')}} - {{ \Carbon\Carbon::parse($schedule->end_date)->format('d, M Y')}}</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <style>
            ul {
                color: #000
            }
            ul li {
                list-style: none;
                cursor: pointer
            }
            .hidden {
                display: none
            }
            </style>
            <ul>
                <?php
                $generations = explode(',', $schedule->generation);
                $program_studies = explode(',', $schedule->program_study);
                $programs = explode(',', $schedule->program);
                foreach ($generations as $generation) {
                    echo '<li onclick=show("#'.$generation.'")><b>'.$generation.'</b>';
                        $program_studies = explode(',', $schedule->program_study);
                        echo '<ul style="border-left:2px dotted black;" class="hidden" id="'.$generation.'">';
                        foreach ($program_studies as $program_study) {
                            $program_study = \App\Models\ProgramStudy::find($program_study);
                            echo '<li onclick=show("#'.$generation.'-'.$program_study->nomor.'")><b>'.$program_study->jurusan.'</b>';
                                echo '<ul style="border-left:2px dotted black;" class="hidden" id="'.$generation.'-'.$program_study->nomor.'">';
                                foreach ($programs as $program) {
                                    $program = \App\Models\Program::find($program);
                                    $url = url('schedule/'.$schedule->id.'/'.$generation.'/'.$program_study->nomor.'/'.$program->nomor);

                                    echo '<li><a href="'.$url.'"><b>'.$program->program.' - '.$program->keterangan.'</b></a></li>';
                                }

                                echo '</ul>';
                            echo '</li>';
                        }
                        echo '</ul>';
                    echo '</li>';
                }
                ?>
            </ul>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>

<script>
    function show(el) {
        if ($(el).hasClass('hidden')) {
            $(el).removeClass('hidden');
        }
    }
</script>

