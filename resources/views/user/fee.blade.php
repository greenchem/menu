@extends('init')

@section('css')
<title>津貼系統</title>
<link rel="stylesheet" href="{{url('assets/css/user/fee.css')}}">
@stop

@section('js')
@stop

@section('content')
@include('user.header')
<div class="container">
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-3" id="menuListBG">
            <div class="btn-group-vertical" role="group" id="menuList">
                <button type="button" class="btn btn-default">值班</button>
                <button type="button" class="btn btn-default">停車費</button>
                <button type="button" class="btn btn-default">宿舍</button>
                <button type="button" class="btn btn-default">伙食費</button>
                <button type="button" class="btn btn-default">伙食費</button>
                <button type="button" class="btn btn-default">伙食費</button>
                <button type="button" class="btn btn-default">伙食費</button>
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
                        @for($i=0; $i<5; $i++)
                        <tr>
                            <td>2016/03/05 08:00 - 2016/03/05 17:00</td>
                            <td>10000000000000000</td>
                        </tr>
                        @endfor
                    </tbody>
                </table>
            </div> <!-- col-lg-9 -->
        </div><!-- row -->
@stop
