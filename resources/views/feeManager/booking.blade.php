@extends('init')

@section('css')
<title>菜單相關設定</title>
@stop

@section('js')
<script src="{{url('assets/js/feeManager/booking.js')}}"></script>
@stop

@section('content')
    @include('feeManager.header')

    <div class="container">
      <div class="row">
        <label for="period">期號</label>
        <select class="form-control" id="period">
            @for($i=0; $i<count($periodData); $i++)
            <option value="{{$periodData[$i]['id']}}">{{$periodData[$i]['name']}}</option>
            @endfor
        </select>
      </div>
      <div class="row">
        <table class="table table-striped" id="logTable">
          <thead>
            <tr>
              <th>期號名稱</th>
              <th>#</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
    </div>
@stop

