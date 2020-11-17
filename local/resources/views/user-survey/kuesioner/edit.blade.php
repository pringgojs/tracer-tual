@extends('layout')

@section('content')
    @include('kuesioner._bread-crumb')
    <div class="row">
        <div class="col-lg-12">
            <div class="card p-20">
                <div class="card-header">
                    <h3 class="box-title m-b-0">Kuesioner</h3>
                    <p class="text-muted m-b-30 font-13"> Fill the blank form </p>
                </div>
                <form class="form-material m-t-40" action="{{url('user-survey/kuesioner/'.$kuesioner->id)}}" method="post">
                    {!! csrf_field() !!}
                    <input name="_method" type="hidden" value="PUT">

                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">Kuesioner</label>
                            <input type="text" id="kuesioner" value="{{$kuesioner->kuesioner}}" name="kuesioner" class="form-control" placeholder="">
                        </div>
                        <div class="form-group">
                            <label>Periode</label>
                            <select class="form-control" name="periode_id" id="grup-kuesioner">
                                @foreach($list_periode as $periode)
                                <option value="{{$periode->id}}" @if($periode->id == $kuesioner->periode_id)  selected @endif>{{$periode->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Nomer Urut</label>
                            <input type="text" id="order-number" value="{{$kuesioner->order_number}}" name="order_number" class="form-control" placeholder="">
                        </div>
                        <div class="form-group"  id="wrap-answer">
                            <label>Daftar Jawaban</label>
                            <table id="answer" class="table table-responsive table-border" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th width='450px'>Jawaban</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($kuesioner->details as $detail)
                                    <tr>
                                        <td><a href="javascript:void(0)" class="remove-row"><i class="fa fa-remove"></i></a></td>
                                        <td>
                                            <input type="text" value="{{$detail->notes}}" name="answer[]"  class="form-control" />
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td></td>
                                    <td><div class="btn btn-success btn-sm btn-circle" onclick="addRow()" id="addRow"><i class="fa fa-plus"></i></div></td>
                                </tr>
                                </tfoot>
                            </table>
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
    @include('kuesioner.include._script-add-row')
@stop