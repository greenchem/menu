@extends('init')

@section('css')
<title>津貼系統 - 伙食</title>
<link rel="stylesheet" href="{{url('assets/css/user/fee.css')}}">
@stop

@section('js')
<script src="{{url('assets/js/user/fee/meal.js')}}"></script>
@stop

@section('content')
@include('user.header')
<div class="container">
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-3" id="menuListBG">
            <div class="btn-group-vertical" role="group" id="menuList">
                <button type="button" class="btn btn-default active"
onclick="window.location='{{url('user/fee/meal')}}'">伙食津貼</button>
                <button type="button" class="btn btn-default"
onclick="window.location='{{url('user/fee/dorm')}}'">住宿津貼</button>
                <button type="button" class="btn btn-default"
onclick="window.location='{{url('user/fee/parking')}}'">停車津貼</button>
                <button type="button" class="btn btn-default"
onclick="window.location='{{url('user/fee/attendance')}}'">值班津貼</button>
                <button type="button" class="btn btn-default"
onclick="window.location='{{url('user/fee/weekendAttendance')}}'">週末值班津貼</button>
            </div>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-9">
            <table class="table table-striped text-center" id="menuTable" >
                <thead>
                    <tr align=center>
                        <th>時間</th>
                        <th>金錢</th>
                    </tr>
                </thead>
                <tbody>
                        @for($i=1; $i<5; $i++)
                        <tr>
                            <td>2016/{{$i}}</td>
                            <td>1000</td>
                        </tr>
                        @endfor
                    </tbody>
                </table>
            </div> <!-- col-lg-9 -->
        </div><!-- row -->
@stop
