@extends('layout')

@section('styles')
<style>

/*Blog widgets*/
.blog-widget {
  margin-top: 30px;
  }
  .blog-widget .blog-image img {
    border-radius: 4px;
    margin-top: -45px;
    margin-bottom: 20px;
    -webkit-box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.2); }
.card-body {
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    padding: 1.25rem;
}
</style>
@stop
@section('content')
    @include('kuesioner._bread-crumb')
    <div class="row">
        @foreach($list_kuesioner_model_answer as $model)
        <div class="col-lg-4 col-xlg-3 col-md-5">
            <div class="card blog-widget">
                <div class="card-body">
                    <div class="blog-image"><img src="../assets/images/big/{{$model->name}}.png" alt="img" class="img-responsive"></div>
                        <h3>Jenis model pertanyaan {{$model->name}}</h3>
                    <p class="m-t-20 m-b-20">
                        {{$model->notes}}
                    </p>
                    <div class="d-flex">
                        
                        <div class="ml-auto">
                            <a href="{{url('kuesioner/'.$model->name.'/create')}}" class="m-t-10 waves-effect waves-dark btn btn-secondary">Gunakan model ini</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@stop