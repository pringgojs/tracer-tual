@extends('layout')
@section('content')

    @include('period.bread-crumb')
    <div class="row">
        <div class="col-lg-12">
            <div class="card p-20">
                <div class="card-header">
                    <h3 class="box-title m-b-0">Periode user survey</h3>
                    <p class="text-muted m-b-30 font-13"></p>
                </div>
                <form class="form-material m-t-40" action="{{url('user-survey/periode')}}" method="post">
                    {!! csrf_field() !!}
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">Name</label>
                            <input type="text" required id="name" name="name" class="form-control" placeholder="">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Status Periode</label>
                            <select name="status" class="form-control" id="">
                                <option value="1">Aktif</option>
                                <option value="0">Non-aktif</option>
                            </select>
                        </div>
                         <div class="form-group">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop