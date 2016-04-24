@extends('init')

@section('css')
<title>禮品清單</title>
<link rel="stylesheet" href="{{url('assets/css/user/menu.css')}}">
@stop

@section('js')
<script src="{{url('assets/js/user/menu.js')}}"></script>
@stop

@section('content')
<input type="hidden" id="currentCompany">
<input type="hidden" id="currentMenu">

@include('user.header')
<div class="container">
    <div class="row">
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-default companyList" data-company="0">生科</button>
            <button type="button" class="btn btn-default companyList" data-company="1">優好</button>
            <button type="button" class="btn btn-default companyList" data-company="2">良農</button>
        </div>
    </div>
    <br>

    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-3" id="menuBG">
            <div class="btn-group-vertical" role="group" id="menuList"></div>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-9">
            <table class="table table-striped" id="productTable">
                <thead>
                    <tr>
                        <th>名稱</th>
                        <th>單位</th>
                        <th>價錢</th>
                        <th>數量</th>
                    </tr>
                </thead>
                <tbody>
                        @for($i=0; $i<5; $i++)
                        <tr>
                            <td>百事可樂</td>
                            <td>瓶</td>
                            <td>100</td>
                            <td>
                                <select class="form-control ammount">
                                    <option disabled>數量</option>
                                    @for($j=0; $j<10; $j++)
                                    <option value="{{$j}}">{{$j}}</option>
                                    @endfor
                                </select>
                            </td>
                        </tr>
                        @endfor
                    </tbody>
                </table>
            </div> <!-- col-lg-9 -->
        </div><!-- row -->
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3"></div>
            <div class="col-lg-9 col-md-9 col-sm-9 text-center">
                <button class="btn btn-primary">加入購物車</button>
            </div>
        </div><!-- container -->
@stop

