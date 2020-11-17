<div class="card-block">
    <h3 class="card-title">{{$kuesioner->kuesioner}}</h3>
    <h6 class="card-subtitle">{!! $kuesioner->showLogic($kuesioner)!!}</h6> 
    <div id="chart-data-{{$kuesioner->id}}" style="height:250px; width:100;"></div>
</div>
<div>
    <hr class="m-t-0 m-b-0">
</div>
<div class="card-block text-center ">
    <ul class="list-inline m-b-0">
        <?php 
            $i = 0;
            $colour =   [ '#26C6DA', '#42A5F5', '#26A69A', '#29B6F6', '#AB47BC', '#EC407A', '#7E57C2', '#5C6BC0'];
            // dd($list_kuesioner);
        ?>
        @foreach($list_kuesioner as $multipleChoice)
        <?php if (!$multipleChoice->kuesionerAnswer) continue;?>
        <li><h6  style="color:{{$colour[$i++]}}"><i class="fa fa-circle font-10 m-r-10 "></i>{{$multipleChoice->kuesionerAnswer->notes}}</h6> </li>
        @endforeach
    </ul>
</div>

<script type="text/javascript">
    Highcharts.chart('chart-data-{{$kuesioner->id}}', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: null
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
                    pie: {
                        showInLegend: true
                    }
                }
            }
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage}</b>'
        },
        subtitle: {
            text: null
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                colors: [ '#26C6DA', '#42A5F5', '#26A69A', '#29B6F6', '#AB47BC', '#EC407A', '#7E57C2', '#5C6BC0'],
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.percentage}</b> ',
                    distance: -20,
                    style: {
                        color: 'white'
                    }
                }
            }
        },
        series: [{
            name: 'jumlah ',            
            innerSize: '60',
            colorByPoint: true,
            data: 
            [
                @foreach($list_kuesioner as $multipleChoice)
                <?php if (!$multipleChoice->kuesionerAnswer) continue;?>
                {
                    name: '{{$multipleChoice->kuesionerAnswer->notes}}',
                    y: {{$multipleChoice->total}}
                },
                @endforeach
            ]
        }]
    });
</script>