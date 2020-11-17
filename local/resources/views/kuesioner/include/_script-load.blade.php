<script>
    function getKuesioner() {
        url = '{{url("/")}}/kuesioner/get-kuesioner-tipe-c';
        $.getJSON(url, function(data) {
            $('#action-logic-kuesioner').html("");
            $('#action-logic-kuesioner').append( '<option value="">-</option>' );
            for (i = 0; i < data.length; i++) {
                $('#action-logic-kuesioner').append( '<option value="'+data[i].id+'">'+data[i].kuesioner+'</option>' );
            }

            $('#action-logic-kuesioner-item').html("");
            $('#action-logic-kuesioner-item').append( '<option value="">-</option>' );
        });
    }

    

    function showLogic() {
        if ($("#is-logic").is(":checked")) {
            $(".bg-faded").show();
            getKuesioner();
        } else {
            $(".bg-faded").hide();
        }
    }
</script>

@include('kuesioner.include._script-add-row')
