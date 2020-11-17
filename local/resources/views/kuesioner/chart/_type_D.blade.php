<div class="earning-widget">
    <div class="card-header">
        <div class="row">
            <div class="col-10">
               <h3 class="card-title">{{$kuesioner->kuesioner}}</h3>
                <h6 class="card-subtitle">{!! $kuesioner->showLogic($kuesioner)!!}</h6>
            </div>
            <div class="col-2">
                <span class="pull-right "><i class="fa fa-angle-down"></i></span>
            </div>
        </div>
    </div>
    <div class="card-body b-t">
        <ul class="feeds">
            <?php
            $i = 1;
            $total = 0;
            foreach ($list_kuesioner->multipleChoice as $item) {
                $alumni_answer_multi_choice = \App\Models\AlumniAnswerMultipleChoiceItem::where('kueswer_multiple_choice_id', $item->id)->get();
                foreach ($alumni_answer_multi_choice as $item_detail) {
                    $total += $item_detail->item->value;
                }
            }?>
            @foreach($list_kuesioner->multipleChoice as $item)
            <?php
            $value = 0;
            $alumni_answer_multi_choice = \App\Models\AlumniAnswerMultipleChoiceItem::where('kueswer_multiple_choice_id', $item->id)->get();
            foreach ($alumni_answer_multi_choice as $item_detail) {
                $value += $item_detail->item->value;
            }

            if ($total == 0) {
                $total = 1;
            }
                $value = $value / $total * 100;
            ?>
            <li class="text-left"><div class="bg-info ctr">{{$i++}}</div> {{$item->notes}} <span class="text-muted">{{\App\Helpers\NumberHelper::formatQuantity($value)}} %</span></li>
            @endforeach
        </ul>
    </div>
</div>