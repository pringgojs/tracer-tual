@extends('layout')

@section('content')
    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor">{{$company->company_name}}</h3>
            <p>{{\App\Helpers\DateHelper::formatView($company->updated_at, true)}}</p>
        </div>
        
        <div class="col-md-7 col-4 align-self-center">
            <a href="{{url('survey-stackholder/company/download/'.$company->id)}}" class="btn waves-effect waves-light btn-danger pull-right hidden-sm-down"> <i class="mdi mdi-download"></i> Download</a>
        </div>
    </div>
    <div class="row">
        <!-- column -->
        <div class="col-lg-12">
            @foreach ($list_survey_answer as $row => $answer)
            <div class="card">
                <div class="card-block">
                    <h4 class="card-title">{{++$row}}. {{$answer->kuesioner->kuesioner}}</h4>
                    <h6 class="card-subtitle">{{$answer->kuesionerAnswer->notes}}</h6>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@stop