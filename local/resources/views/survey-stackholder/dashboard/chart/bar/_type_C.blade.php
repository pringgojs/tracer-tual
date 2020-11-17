<div class="card-block">
    <h3 class="card-title">{{$kuesioner->kuesioner}}</h3>
    <h6 class="card-subtitle">{{$kuesioner->description}}</h6> 
    <div id="chart-data-{{$kuesioner->id}}" style="height:250px; width:100%;"></div>
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
                format: '{point.y:.1f}'
            },
            colors: [ '#26C6DA', '#42A5F5', '#26A69A', '#29B6F6', '#AB47BC', '#EC407A', '#7E57C2', '#5C6BC0', '#D81B60', '#7B1FA2', '#E57373', '#5C6BC0', '#7986CB', '#B39DDB', '#80CBC4', '#009688', '#43A047', '#66BB6A', '#81C784' ],
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
    },

    series: [{
        name: 'Answers',
        colorByPoint: true,
        data: [
            @foreach($list_kuesioner as $kuesioner)
                {
                    name: '{{$kuesioner->kuesionerAnswer->notes}}',
                    y: {{$kuesioner->total}},
                    drilldown: '{{$kuesioner->kuesionerAnswer->notes}}'
                },
            @endforeach
        ],
    
    }]
});
</script>