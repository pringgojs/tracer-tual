<style>
    .selected {
        border: 3px solid #1e88e5;
    }

    .chart {
        width: 180px;
        height: 180px;
        {{--  border: 3px;  --}}
    }
</style>
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" >Pilih jenis chart yang akan ditampilkan di Beranda</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="col-12">
            <div class="modal-body">
                <form id="setting-chart">
                    {!! csrf_field() !!}
                    <input type="hidden" name="kuesioner_id" value="{{$kuesioner->id}}">
                    <input type="hidden" readonly name="chart_type" value="{{$setting ? $setting->type_of_chart : '' }}" id="chart-type">
                    <img src="{{asset('assets/images/bar.png')}}" onclick="selectChart('bar', 'bar-chart')" class="chart @if($setting) {{$setting->type_of_chart == 'bar' ? 'selected' : '' }} @endif" id="bar-chart">
                    <img src="{{asset('assets/images/pie.png')}}" onclick="selectChart('pie', 'pie-chart')" class="chart @if($setting) {{$setting->type_of_chart == 'pie' ? 'selected' : '' }} @endif" id="pie-chart">
                </form>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-success save" onclick="saveSetting()" data-dismiss="modal">Submit</button>
            <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>
<script>
    function selectChart(value, el) {
        $('#chart-type').val(value);
        $('img').removeClass('selected');
        $('#'+el).addClass('selected');
    }

    function saveSetting(){
        type = $("#chart-type").val();
        if (type == "") {
            alert("Failed", "Please complate required form");
            return false;
        }

        data = $("#setting-chart").serialize();
        $(".save").html("Saving...");
        $.ajax({
            type:'POST',
            url: "{{URL::to('kuesioner/setting')}}",
            data:data,
            success: function(result){
                $(".save").html("Simpan");
                {{--  $('#modal-detail').modal('hide');  --}}

            }, error: function(result){
                console.log(result);
               alert("Failed","something went wrong", "error");
                {{--  $('#modal-detail').modal('hide');  --}}
            }
        });
    }
</script>
