<div class="card-block">
    <h3 class="card-title">{{$kuesioner->kuesioner}}</h3>
    <h6 class="card-subtitle">{!! $kuesioner->showLogic($kuesioner)!!}</h6> 
</div>
<div class="table-responsive">
    <table class="table color-table info-table">
        <tr>
            <td>No</td>
            <td>Jawaban</td>
            <td>Total</td>
        </tr>
        <?php $i = 1;?>
        @foreach($list_kuesioner as $kuesioner)
        <tr>
            <td>{{$i++}}</td>    
            <td>{{$kuesioner->description}}</td>    
            <td>{{$kuesioner->total}}</td>    
        </tr>
        @endforeach
    </table>
</div>