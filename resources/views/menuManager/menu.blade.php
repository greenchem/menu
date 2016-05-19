@extends('init')

@section('css')
<title>菜單系統 - 管理菜單</title>
<link rel="stylesheet" href="{{url('assets/css/menuManager/menu.css')}}">
@stop

@section('js')
<script src="{{url('assets/js/menuManager/menu.js')}}"></script>
@stop

@section('content')
    @include('menuManager.header')

    <input type="hidden" id="url" value="{{url('')}}">
    <input type="hidden" id="currentMenuId">

    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3 text-center addMenuDiv">
                <button class="btn btn-primary" onclick="window.location='{{url('menuManager/add')}}'">新增菜單</button>
            </div>
        </div>
<br>
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3">
                <ul class="nav nav-pills nav-stacked" id="menuList">
                    @for($i=0; $i<count($menuData); $i++)
                    <li role="presentation" data-id="{{$menuData[$i]['id']}}">
                        <a href="#">{{$menuData[$i]['name']}}</a>
                    </li>
                    @endfor
                </ul>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-9 menuContent">
                <table class="table table-striped" id="menuTable">
                    <thead>
                        <tr>
                            <th>名稱</th>
                            <th>單位</th>
                            <th>庫存</th>
                            <th>價錢</th>
                            <th>描述</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
        <div class="row menuContent">
            <div class="col-lg-3 col-md-3 col-sm-3"></div>
            <div class="col-lg-9 col-md-9 col-sm-9 text-center">
                <button class="btn btn-primary" id="editBtn">編輯</button>
                <button class="btn btn-danger" id="deleteBtn">刪除</button>
            </div>
        </div>
    </div>
@stop

