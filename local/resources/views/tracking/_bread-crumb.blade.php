<style>
    .column {
        width: auto;
        float: left;
        margin-right: 20px 
    }
    .column .timer {
        padding: 0px;
        height: 40px;
    }
    .column .text {
        font-size: 12px;
    }
</style>
<div class="row page-titles">
    <div class="col-lg-8 col-md-5 col-xs-12 align-self-center">
        <h3 class="text-themecolor">Tracking Peserta</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
            <li class="breadcrumb-item active">Tracking Peserta</li>
        </ol>
    </div>
    <div class="col-lg-4 col-md-7 col-xs-12 align-self-center text-right">
        <div class="col-md-12">
            <div class="time row pull-right" id="time">
                <div class="column"><i class="fa fa-calendar text-info"></i></div>
                <div class="column">
                    <div class="timer" id="days"></div>
                    <div class="text">Hari</div>
                </div>

                <div class="column">
                    <div class="timer" id="hours"></div>
                    <div class="text">Jam</div>
                </div>

                <div class="column">
                    <div class="timer" id="minutes"></div>
                    <div class="text">Menit</div>
                </div>

                <div class="column">
                    <div class="timer" id="seconds"></div>
                    <div class="text">Detik</div>
                </div>
            </div>
        </div>
        <div class="col-md-12 pull-right text-primary m-r-20">
            <b style="padding:5px; border-radius: 2px; background: #eee">Jadwal: {{ \Carbon\Carbon::parse($schedule->start_date)->format('d, M Y')}} - {{ \Carbon\Carbon::parse($schedule->end_date)->format('d, M Y')}}</b>
        </div>
    </div>
</div>