@extends('layout')

@section('content')
    @include('user.bread-crumb')
    <div class="row">
        <div class="col-lg-12">
            <div class="card p-20">
                <div class="card-header">
                    <h3 class="box-title m-b-0">User</h3>
                    <p class="text-muted m-b-30 font-13">Create new</p>
                </div>
                <form class="form-material m-t-40" action="{{url('user')}}" method="post">
                    {!! csrf_field() !!}
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">Name</label>
                            <input type="text" required id="name" name="name" class="form-control" placeholder="">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Email</label>
                            <input type="email" required id="email" name="email" class="form-control" placeholder="">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Password</label>
                            <input type="password" required id="password" name="password" class="form-control" placeholder="">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Role</label>
                            <div class="col-md-4">
                                <select name="role" id="" class="form-control">
                                    @foreach ($roles as $role)
                                        <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group surveyor" style="display:none">
                            <label class="control-label">Phone</label>
                            <input type="text" disabled="disabled" required id="phone" name="phone" class="form-control" placeholder="">
                        </div>
                        <div class="form-group surveyor" style="display:none">
                            <label class="control-label">address</label>
                            <input type="text" disabled="disabled" required id="address" name="address" class="form-control" placeholder="">
                        </div>
                        <div class="form-group surveyor"  style="display:none">
                            <label class="control-label">Program Study</label>
                            <select class="form-control" required name="program_study" id="program-study" class="form-control">
                                @foreach($program_studies as $study)
                                <option value="{{$study->nomor}}">{{$study->jurusan}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group surveyor"  style="display:none">
                            <label class="control-label">Generation</label>
                            <select class="form-control" required name="generation" id="generation" class="form-control">
                                @foreach($generations as $generation)
                                <option value="{{$generation->angkatan}}">{{$generation->angkatan}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script>
    function isSurveyor() {
        if ($("#is-surveyor").is(":checked")) {
            $(".surveyor").show();
            $(".surveyor input").prop('disabled', false);
        } else {
            $(".surveyor").hide();
            $(".surveyor input").prop('disabled', true);
        }
    }
    </script>
@endsection
