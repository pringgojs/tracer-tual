@extends('layout')

@section('content')
    @include('group._bread-crumb')
    <div class="row">
        <div class="col-lg-12">
            <div class="card p-20">
                <div class="card-header">
                    <h3 class="box-title m-b-0">Group</h3>
                    <p class="text-muted m-b-30 font-13">Group of Kuesiner </p>
                </div>
                <form class="form-material m-t-40" action="{{url('group')}}" method="post">
                    {!! csrf_field() !!}
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">Name</label>
                            <input type="text" id="group" required name="name" class="form-control" placeholder="">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Description <br><small>used to provide a description of the group</small></label>
                            <input type="text" id="group" required name="description" class="form-control" placeholder="">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Link of Group Name <br><small>used to create links for each group. example<code>education-history</code></small></label>
                            <input type="text" id="group" required name="link" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label>Order number <br><small>used to sort groups</small></label>
                            <input type="number" min="1" max="100" required id="order_number" name="order_number" class="form-control" placeholder="">
                        </div>
                        <div class="form-group">
                            <label>Icon</label>
                            <?php
                            $icons = array('fa fa-user', 'fa fa-eyedropper', 'fa fa-map', 'fa fa-university', 'fa fa-suitcase', 'fa fa-tasks', 
                                'fa fa-paw', 'fa fa-unlock  ', 'fa fa-sheqel', 'fa fa-rocket', 'fa fa-send', 'fa fa-ship', 'fa fa-tint', 'fa fa-mortar-board', 
                                'fa fa-th', 'fa fa-cubes', 'fa fa-crosshairs', 'fa fa-check', 'fa fa-lock', 'fa fa-magnet', 'fa fa-sun-o', 'fa fa-life-saver', 
                                'fa fa-trophy ', 'fa fa-snowflake-o ', 'fa fa-hashtag', 'fa fa-scissors ', 'fa fa-navicon  ', 'fa fa-dot-circle-o', 'fa fa-futbol-o', 'fa fa-circle-o-notch  ');
                            ?>
                            <div id="element-icon">
                                @foreach($icons as $icon)
                                    <button type="button" class="btn btn-sm btn-circle" onclick="selectIcon('{{$icon}}')"><i class="{{$icon}}"></i></button>
                                @endforeach
                                <input type="hidden" name="icon" readonly id="icon">
                            </div>
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
function selectIcon(icon) {
    $("#icon").val(icon);
}

$("#element-icon button").click(function() {
  $("#element-icon button").removeClass('btn-warning');
    $(this).addClass('btn-warning');
});
</script>
@stop