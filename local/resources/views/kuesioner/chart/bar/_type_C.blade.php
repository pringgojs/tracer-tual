<div class="card-block">
    <h3 class="card-title">{{$kuesioner->kuesioner}} </h3>
    <h6 class="card-subtitle">{!! $kuesioner->showLogic($kuesioner)!!}</h6> 
    <div id="chart-data-{{$kuesioner->id}}" style="height:250px; width:100;"></div>
</div>

<script type="text/javascript">
Highcharts.chart('chart-data-{{$kuesioner->id}}', {
    chart: {
        type: 'column'
    },
    exporting:{
        chartOptions:{
            title: {
                text:'{{$kuesioner->kuesioner}}',
                x: -20
            },
            subtitle: {
                text: '{{$kuesioner->description}}'
            },
            plotOptions: {
                column: {
                    showInLegend: true
                }
            },
            xAxis: {
                type: 'category',
                labels: {
                    enabled: true
                }
            },
        }
    },
    title: null,
    subtitle: null,
    xAxis: {
        type: 'category',
        labels: {
            enabled: true
        }
    },
    yAxis: {
        title: {
            text: 'Total'
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y}'
            },
            colors: [ '#26C6DA', '#42A5F5', '#26A69A', '#29B6F6', '#AB47BC', '#EC407A', '#7E57C2', '#5C6BC0', '#D81B60', '#7B1FA2', '#E57373', '#5C6BC0', '#7986CB', '#B39DDB', '#80CBC4', '#009688', '#43A047', '#66BB6A', '#81C784' ],
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}</b> of total<br/>'
    },

    series: [{
        name: 'Answers',
        colorByPoint: true,
        data: [
            @foreach($list_kuesioner as $kuesioner)
                <?php if (!$kuesioner->kuesionerAnswer) continue;?>
                {
                    name: '{{$kuesioner->kuesionerAnswer->notes}}',
                    y: {{$kuesioner->total}}
                },
            @endforeach
        ],
    
    }],
    drilldown: {
        series: [
            @foreach($list_kuesioner as $kuesioner)
            <?php if (!$kuesioner->kuesionerAnswer) continue;?>
            <?php
            $list_alumni_answer_by_periode = \App\Models\AlumniAnswer::joinPeriode()
                ->joinAnswerMultipleChoice()
                ->where('kuesioner_id', $kuesioner->kuesionerAnswer->kuesioner_id)
                ->where('alumni_answer_multiple_choice.kueswer_multiple_choice_id', $kuesioner->kueswer_multiple_choice_id)
                ->selectRaw('periode_id, count(periode_id) as total')
                ->groupBy('periode_id')
                ->get();
            ?>
                {
                    name: '{{$kuesioner->kuesionerAnswer->notes}}',
                    id: '{{$kuesioner->kuesionerAnswer->notes}}',
                    data: [
                        @foreach ($list_alumni_answer_by_periode as $item)
                            ['{{$item->periode->name}}', {{$item->total}}],
                        @endforeach
                    ]
                },
            @endforeach
        ]
    }
});
</script>