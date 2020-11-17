<div class="grid-stack">
    @foreach ($layouts as $layout)
        <?php
            $setting = unserialize($layout->json_layout);
            $list_kuesioner = \App\Models\Survey\SurveyAnswer::chart($layout->kuesioner_id, $layout->user_id, $filter);
        ?>

        <div class="grid-stack-item" data-gs-x="{{$setting['x'] ? : 0}}" data-gs-y="{{$setting['y'] ? : 3}}" data-gs-width="{{$setting['width'] ? : 4}}" data-gs-height="{{$setting['height'] ? : 5}}">
            <div class="grid-stack-item-content card">
                @if($list_kuesioner)
                    @if ($layout->type_of_chart == 'bar')
                        
                        @include('survey-stackholder.dashboard.chart.bar._type_C', ['list_kuesioner' => $list_kuesioner, 'kuesioner' => $layout->kuesioner])
                    @else
                        
                        @include('survey-stackholder.dashboard.chart.pie._type_C', ['list_kuesioner' => $list_kuesioner, 'kuesioner' => $layout->kuesioner])
                    @endif
                @else
                TIDAK ADA DATA YANG BISA DITAMPILKAN
                @endif
            </div>
        </div>
    @endforeach
</div>
<textarea style="margin-top:350px; display:none" id="saved-data" cols="100" rows="20" readonly="readonly"></textarea>


<script type="text/javascript">
    $(function () {
        var options = {
            cellHeight: 80,
            verticalMargin: 10,
            resizable: {
                handles: 'e, se, s, sw, w'
            }
        };
        $('.grid-stack').gridstack(options);

        new function () {
            this.saveGrid = function () {
                this.serializedData = _.map($('.grid-stack > .grid-stack-item:visible'), function (el) {
                    el = $(el);
                    var node = el.data('_gridstack_node');
                    return {
                        x: node.x,
                        y: node.y,
                        width: node.width,
                        height: node.height
                    };
                }, this);
                $('#saved-data').val(JSON.stringify(this.serializedData, null, '    '));
                saveLayout();
                return false;
            }.bind(this);

            $('#save-grid').click(this.saveGrid);
        }
    });

    function saveLayout() {
        var data = $('#saved-data').val();
        $.post("{{url('survey-stackholder/save-layout')}}", {data : data, _token: $('meta[name="csrf-token"]').attr('content')}, 
            function(res){
                console.log(res);
            }
        );
    }
</script>