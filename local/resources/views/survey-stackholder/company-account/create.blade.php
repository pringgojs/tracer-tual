@extends('layout')
@section('content')

    @include('survey-stackholder.company-account.bread-crumb')
    <div class="row">
        <div class="col-lg-12">
            <div class="card p-20">
                <div class="card-header">
                    <h3 class="box-title m-b-0">Akun Perusahaan</h3>
                    <p class="text-muted m-b-30 font-13"></p>
                </div>
                <form class="form-material m-t-40" action="{{url('survey-stackholder/company-account')}}" method="post">
                    {!! csrf_field() !!}
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">Username</label>
                            <input type="text" required id="name" name="username" class="form-control" placeholder="">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Password <button type="button" class="btn btn-xs btn-info" onclick="makeid()">Generate password</button></label>
                            <input type="text" required id="password" name="password" class="form-control" placeholder="">
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

@section('scripts')
<script>
function makeid() {
  var text = Math.random().toString(36).substring(3, 10);
  $('#password').val(text);
}

</script>
@stop
