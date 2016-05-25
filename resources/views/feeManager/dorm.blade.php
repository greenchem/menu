@extends('init')

@section('css')
<title>津貼系統 - 住宿</title>
<link rel="stylesheet" href="{{url('assets/css/feeManager/fee.css')}}">
@stop

@section('js')
<script src="{{url('assets/js/feeManager/month.js')}}"></script>
<script src="{{url('assets/js/feeManager/dataCheck.js')}}"></script>
<script src="{{url('assets/js/feeManager/produceHTML.js')}}"></script>
@stop

@section('content')
    @include('feeManager.header')

    <input type="hidden" value="dorm" id="type">
    <input type="hidden" value="{{$groupData}}" id="groupData">
    <input type="hidden" id="currentEditCreationStatus">
    <input type="hidden" id="currentEditCreationId">

    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3"></div>
            <div class="col-lg-9 col-md-9 col-sm-9 text-center">
                <h3>津貼系統 - 住宿津貼</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3" id="menuListBG">
                <div class="btn-group-vertical" role="group" id="menuList">
                    <button type="button" class="btn btn-default"
onclick="window.location = '{{url('feeManager/meal')}}'">伙食</button>
<button type="button" class="btn btn-default active"
onclick="window.location = '{{url('feeManager/dorm')}}'">住宿</button>
<button type="button" class="btn btn-default"
onclick="window.location = '{{url('feeManager/parking')}}'">停車費</button>
<button type="button" class="btn btn-default"
onclick="window.location = '{{url('feeManager/attendance')}}'">值班</button>
<button type="button" class="btn btn-default"
onclick="window.location = '{{url('feeManager/weekendAttendance')}}'">假日值班</button>
            </div>
        </div>

        <div id="feeContentDiv" class="col-lg-9 col-md-9 col-sm-9">
            <ul id="feeClassBG" class="nav nav-tabs">
              <li role="presentation" class="active addRecordDiv"><a href="#">新增</a></li>
                <li role="presentation" class="manageDiv"><a href="#">管理</a></li>
            </ul>

            @include('feeManager.fee.month_add')
            @include('feeManager.fee.edit')

            </div> <!-- col-lg-9 -->
        </div><!-- row -->
    </div><!-- container -->
@stop

