@extends('layout')

@section('content')
    @include('user.bread-crumb')
    <div class="row">
        <div class="col-lg-12">
            <div class="card p-20">
                <div class="card-header">
                    <h3 class="box-title m-b-0">User</h3>
                    <p class="text-muted m-b-30 font-13">Update</p>
                </div>
                <form class="form-material m-t-40" action="{{url('user/'.$user->id)}}" method="post">
                    {!! csrf_field() !!}
                    <input name="_method" type="hidden" value="PUT">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">Name</label>
                            <input type="text" required id="name" value="{{$user->name}}" name="name" class="form-control" placeholder="">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Email</label>
                            <input type="email" required id="email" value="{{$user->email}}" name="email" class="form-control" placeholder="">
                        </div>
                        @if($user->id != 1)
                        <div class="form-group">
                            <label class="control-label">Password (Optional)</label>
                            <input type="password" id="password"  name="password" class="form-control" placeholder="">
                        </div>
                        @endif
                        <div class="form-group">
                            <label class="control-label">Role</label>
                            <div class="col-md-4">
                                <select name="role" class="form-control" id="">
                                    @foreach ($roles as $role)
                                        <option value="{{$role->id}}" @if($role->id == $user->roles->first()->id) selected @endif>{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        {{-- <div class="form-group surveyor" style="display:@if(!$user->surveyor) none @endif">
                            <label class="control-label">Phone</label>
                            <input type="text" required value="{{$user->surveyor ? $user->surveyor->phone : ''}}" id="phone" name="phone" class="form-control" placeholder="">
                        </div>
                        <div class="form-group surveyor" style="display:@if(!$user->surveyor) none @endif">
                            <label class="control-label">address</label>
                            <input type="text"  @if(!$user->surveyor) disabled="disabled" @endif  value="{{$user->surveyor ? $user->surveyor->address : ''}}" required id="address" name="address" class="form-control" placeholder="">
                        </div>
                        <div class="form-group surveyor"  style="display:@if(!$user->surveyor) none @endif">
                            <label class="control-label">Program Study</label>
                            <select class="form-control" required name="program_study" id="program-study" class="form-control">
                                @foreach($program_studies as $study)
                                <option value="{{$study->nomor}}" @if($user->surveyor)  {{$user->surveyor->program_study_id == $study->nomor ? 'selected':''}} @endif>{{$study->jurusan}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group surveyor"  style="display:@if(!$user->surveyor) none @endif">
                            <label class="control-label">Generation</label>
                            <select class="form-control" required name="generation" id="generation" class="form-control">
                                @foreach($generations as $generation)
                                <option value="{{$generation->angkatan}}" @if($user->surveyor)  {{$user->surveyor->generation == $generation->angkatan ? 'selected':''}} @endif>{{$generation->angkatan}}</option>
                                @endforeach
                            </select>
                        </div> --}}
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
