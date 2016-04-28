@extends('init')

@section('css')
    <title>津貼系統 - 假日值班</title>
    <link rel="stylesheet" href="{{url('assets/css/manager/fee.css')}}">
@stop

@section('js')
    <script src="{{url('assets/js/manager/fee/weekendAttendance.js')}}"></script>
@stop

@section('content')
    @include('manager.header')
<div class="container">
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-3"></div>
        <div class="col-lg-9 col-md-9 col-sm-9 text-center">
            <h3>津貼系統 - 週末值班津貼</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-3" id="menuListBG">
            <div class="btn-group-vertical" role="group" id="menuList">
            <button type="button" class="btn btn-default"
onclick="window.location = '{{url('manager/fee/meal')}}'">伙食</button>
<button type="button" class="btn btn-default"
onclick="window.location = '{{url('manager/fee/dorm')}}'">住宿</button>
<button type="button" class="btn btn-default"
onclick="window.location = '{{url('manager/fee/parking')}}'">停車費</button>
<button type="button" class="btn btn-default"
onclick="window.location = '{{url('manager/fee/attendance')}}'">值班</button>
<button type="button" class="btn btn-default active"
onclick="window.location = '{{url('manager/fee/weekendAttendance')}}'">假日值班</button>
            </div>
        </div>

        <div id="feeContentDiv" class="col-lg-9 col-md-9 col-sm-9">
            <h1>暫無資料格式</h1>
        </div> <!-- col-lg-9 -->
    </div><!-- row -->
</div><!-- container -->
@stop

