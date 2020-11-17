
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" >{{$kuesioner->kuesioner}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="col-12">
                <div class="modal-body">
                    @if($kuesioner->modelAnswer->name == 'C' || $kuesioner->modelAnswer->name == 'E')
                        <ol type="A">
                            @foreach($kuesioner->multipleChoice as $item)
                            <li>{{$item->notes}}</li>
                            @endforeach
                        </ol>
                    @endif
                    @if($kuesioner->modelAnswer->name == 'D')
                    <div class="table-responsive">
                        <table class="table color-table info-table">
                            <thead>
                            <tr>
                                <th>Item</th>
                                <th class="text-center" colspan="{{$kuesioner->multipleChoiceItem->count()}}">Value</th>
                            </tr>
                            </thead>
                            @foreach($kuesioner->multipleChoice as $question)
                            <tr>
                                <td>{{$question->notes}}</td>
                                @foreach($kuesioner->multipleChoiceItem as $item)
                                    <td>{{$item->value}}</td>
                                @endforeach 
                            </tr>   
                            @endforeach 
                        </table>
                    </div>
                    Notes : 
                    <div class="table-responsive">
                        <table class="table color-table success-table">
                            <thead>
                            <tr>
                                <th>Notes</th>
                                <th>Value</th>
                            </tr>
                            </thead>
                            @foreach($kuesioner->multipleChoiceItem as $item)
                            <tr>
                                <td>{{$item->notes}}</td>
                                <td>{{$item->value}}</td>
                            </tr>   
                            @endforeach 
                        </table>
                    </div>
                    @endif
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>

