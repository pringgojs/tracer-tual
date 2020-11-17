<div class="modal hide fade" id="modal-group" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
    <div class="modal-dialog" role="document">
        <form id="group" method="post" action="{{url('grup/save')}}">
            {!! csrf_field() !!}
            
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel1">Grup Baru</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Nama grup</label>
                        <input type="text" class="form-control" id="grup-name" name="grup_name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary save" onclick="store()">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    function store(){
        name = $("#grup-name").val();
        if (name == "") {
            alert("Failed", "Please complate required form");
            return false;
        }

        data = $("#group").serialize();
        $(".save").html("Saving...");
        $.ajax({
            type:'POST',
            url: "{{URL::to('grup/store')}}",
            data:data,
            success: function(result){
                $(".save").html("Simpan");
                if (result.status == 'failed') {
                    alert("Failed","Please select another name", "error");
                    return false;
                }
                
                callback(result);
            }, error: function(result){
               alert("Failed","something went wrong", "error");
               closeModal();
            }
        });
    }

    function callback(data) {
        console.log(data.group.grup);
        $('#grup-kuesioner').append('<option value='+data.group.id+' selected="selected">'+data.group.grup+'</option>');
        closeModal();
    }

    function closeModal() {
        $('#grup-name').val('');
        $("#modal-group").modal('hide');
    }

</script>
