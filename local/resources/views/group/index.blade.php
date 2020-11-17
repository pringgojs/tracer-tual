@extends('layout')

@section('content')
    @include('group._bread-crumb')

    <div class="row">
        <!-- column -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-block">
                    <h4 class="card-title">Group</h4>
                    <h6 class="card-subtitle">Group of kuesioner</h6>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th >#</th>
                                    <th >Name</th>
                                    <th >Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=0;?>
                                @foreach($groups as $group)
                                <tr id="group-{{$group->id}}">
                                    <td>{{++$i}}</td>
                                    <td>{{ $group->name}}</td>
                                    <td>
                                        <form action="{{url('group/'.$group->id)}}" method="post">
                                            {!! csrf_field() !!}
                                            <a class="btn btn-info" href="{{url('group/'.$group->id.'/edit')}}" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil"></i> </a>
                                            <input type="hidden" name="_method" value="delete" />
                                            <button class="btn btn-danger" data-toggle="tooltip" data-original-title="scri"> <i class="fa fa-close"></i> </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
<script>
    $(document).ready(function () {
        $('tbody').sortable({
            axis: 'y',
            stop: function (event, ui) {
                var data = $(this).sortable('serialize');
                console.log(data);
                $.ajax({
                    data: { "_token": "{{ csrf_token() }}", data},
                    type: 'POST',
                    url: '{{url("group/sort")}}',
                    success: function(res) {
                        console.log(res);
                    },
                });
            }
        });
    });
</script>
@stop