<script>
    var t = $('#answer').DataTable({
        bSort: false,
        bPaginate: false,
        bInfo: false,
        bFilter: false,
        bScrollCollapse: false
    });

    var counter = 1;

    function addRow() {
        t.row.add( [
            '<a href="javascript:void(0)" class="remove-row"><i class="fa fa-remove"></i></a>',
            '<input type="text" name="answer[]"  class="form-control" /><input type="hidden" name="item_id[]" class="form-control" />',
        ] ).draw( false );
    }
    
    $('#answer tbody').on('click', '.remove-row', function () {
        t.row($(this).parents('tr')).remove().draw();
    });
</script>

{{-- table logic --}}

<script>
    var tb_logic = $('#table-logic').DataTable({
        bSort: false,
        bPaginate: false,
        bInfo: false,
        bFilter: false,
        bScrollCollapse: false
    });

    var counterx = 1;

    function addRowTableLogic() {
        tb_logic.row.add( [
            '<select class="form-control" name="action_logic_kuesioner[]" onchange="getAnswer(this.value, '+counterx+')" id="action-logic-kuesioner-'+counterx+'">'
                +'<option value="">Pilih kuesioner</option>'
                @foreach($list_kuesioner_model_c as $kuesioner_c)
                +'<option value="{{$kuesioner_c->id}}">{{$kuesioner_c->kuesioner}}</option>'
                @endforeach
            +'</select>',
            '<select class="form-control" name="action_logic_kuesioner_item[]" id="action-logic-kuesioner-item-'+counterx+'"></select>',
            '<a href="javascript:void(0)" class="remove-row"><i class="fa fa-remove"></i></a>',
        ] ).draw( false );
        counterx++;
    }
    
    $('#table-logic tbody').on('click', '.remove-row', function () {
        tb_logic.row($(this).parents('tr')).remove().draw();
    });

    function getAnswer(kuesioner_id, index) {
        $('#action-logic-kuesioner-item-'+index).html("");
        $('#action-logic-kuesioner-item-'+index).append( '<option value="">-</option>' );
        
        if (!kuesioner_id) {
            return false;
        }

        url = '{{url("/")}}/kuesioner/get-answer/'+kuesioner_id;
        $.getJSON(url, function(data) {
            for (i = 0; i < data.length; i++) {
                $('#action-logic-kuesioner-item-'+index).append( '<option value="'+data[i].id+'">'+data[i].notes+'</option>' );
            }
        });
    }

    /** hapus item **/
    function removeMultipleItem(id) {
        var t = confirm('Anda yakin ingin menghapus permanen data ini ? Data yang berelasi dengan item ini akan dihapus permanen. Data yang sudah dihapus tidak dapat dikembalikan');
        if (!t) return;
        $.ajax({
            url: '{{url("kuesioner/remove-item")}}/'+id,
            success: function (res) {
                $('#tr-multi-item-'+id).hide();
                notification('Berhasil dihapus');
            },
            error: function (res) {
                notification('Gagal dihapus');
            }
        })
    }

    /** hapus item **/
    function removeLogic(id) {
        var t = confirm('Anda yakin ingin menghapus permanen data ini ? Data yang berelasi dengan item ini akan dihapus permanen. Data yang sudah dihapus tidak dapat dikembalikan');
        if (!t) return;
        $.ajax({
            url: '{{url("kuesioner/remove-logic")}}/'+id,
            success: function (res) {
                $('#tr-logic-'+id).hide();
                notification('Berhasil dihapus');
            },
            error: function (res) {
                notification('Gagal dihapus');
            }
        })
    }
</script>