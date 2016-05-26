@extends('init')

@section('css')
<title>津貼報表匯出</title>
@stop

@section('js')
<script src="{{url('assets/js/feeManager/feeExport.js')}}"></script>
@stop

@section('content')
    @include('feeManager.header')

    <input type="hidden" value="{{$creationLog}}" id="creationLog">

    <div class="container">
      <div class="row">
        <label for="period">類型</label>
        <select class="form-control" id="type">
            <option value="meal">伙食</option>
            <option value="dorm">住宿</option>
            <option value="parking">停車</option>
            <option value="attendance">值班</option>
            <option value="weekendAttendance">假日值班</option>
        </select>
      </div>
      <div class="row">
        <label for="timestamp">時間</label>
        <select class="form-control" id="timestamp"></select>
      </div>
        <br>

        <div class="row text-center">
            <button class="btn btn-primary" id="exportBtn">匯出</button>
        </div>
    </div>
@stop

