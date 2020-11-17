
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" >{{$kuesioner->kuesioner}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="col-12">
                <div class="modal-body">
                    <ol type="A">
                        @foreach($kuesioner->details as $item)
                        <li>{{$item->notes}}</li>
                        @endforeach
                    </ol>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>

