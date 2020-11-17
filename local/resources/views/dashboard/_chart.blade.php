@include('dashboard._count')
<div class="grid-stack">
    @foreach ($layouts as $layout)
        <?php
            $setting = unserialize($layout->json_layout);
            $list_kuesioner = \App\Models\AlumniAnswer::chart($layout->kuesioner_id, $filter);
            if ($layout->kuesioner_id == 7) {
                // dd($list_kuesioner);
            }
        ?>
        
        <div class="grid-stack-item" data-gs-x="{{$setting['x'] ? : 0}}" data-gs-y="{{$setting['y'] ? : 3}}" data-gs-width="{{$setting['width'] ? : 4}}" data-gs-height="{{$setting['height'] ? : 5}}">
            <div class="grid-stack-item-content card">
                @if($list_kuesioner)
                    @if($layout->kuesioner->kuesioner_model_answer_id == 1)
                        @include('kuesioner.chart._type_A', ['list_kuesioner' => $list_kuesioner, 'kuesioner' => $layout->kuesioner])
                    @endif

                    @if($layout->kuesioner->kuesioner_model_answer_id == 2)
                        @include('kuesioner.chart._type_B', ['list_kuesioner' => $list_kuesioner, 'kuesioner' => $layout->kuesioner])
                    @endif

                    @if($layout->kuesioner->kuesioner_model_answer_id == 3)
                        @if ($layout->type_of_chart == 'bar')
                            @include('kuesioner.chart.bar._type_C', ['list_kuesioner' => $list_kuesioner, 'kuesioner' => $layout->kuesioner])
                            @else
                            @include('kuesioner.chart.pie._type_C', ['list_kuesioner' => $list_kuesioner, 'kuesioner' => $layout->kuesioner])
                        @endif
                    @endif

                    @if($layout->kuesioner->kuesioner_model_answer_id == 4)
                        {{--  @if ($  == 'bar')
                            @include('kuesioner.chart.bar._type_D', ['list_kuesioner' => $list_kuesioner, 'kuesioner' => $layout->kuesioner])
                        @elseif ($layout->type_of_chart == 'pie')
                            @include('kuesioner.chart.pie._type_D', ['list_kuesioner' => $list_kuesioner, 'kuesioner' => $layout->kuesioner])
                        @else  --}}
                            @include('kuesioner.chart._type_D', ['list_kuesioner' => $list_kuesioner, 'kuesioner' => $layout->kuesioner])
                        {{--  @endif  --}}

                    @endif

                    @if($layout->kuesioner->kuesioner_model_answer_id == 5)
                        @if ($layout->type_of_chart == 'bar')
                            @include('kuesioner.chart.bar._type_C', ['list_kuesioner' => $list_kuesioner, 'kuesioner' => $layout->kuesioner])
                            @else
                            @include('kuesioner.chart.pie._type_C', ['list_kuesioner' => $list_kuesioner, 'kuesioner' => $layout->kuesioner])
                        @endif
                        {{-- @include('kuesioner.chart._type_E', ['list_kuesioner' => $list_kuesioner, 'kuesioner' => $layout->kuesioner]) --}}
                    @endif

                @else
                Tidak ada data yang bisa ditampilkan
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
        $.post("{{url('dashboard/save-layout')}}", {data : data, _token: $('meta[name="csrf-token"]').attr('content')}, 
            function(res){
                console.log(res);
            }
        );
    }
</script>