@extends('init')

@section('css')
<title>菜單系統 - 新增菜單</title>
@stop

@section('js')
<script src="{{url('assets/js/menuManager/add.js')}}"></script>
@stop

@section('content')
    @include('menuManager.header')
    @include('menuManager.addModal')
    @include('menuManager.editModal')

    <input type="hidden" id="url" value="{{url('')}}">
    <h3 class="text-center">新增菜單</h3>
    <div class="container">
        <div class="row">
            <label for="menuName">菜單名稱</label>
            <input type="text" class="form-control" id="menuName">
        </div>
        <div class="row">
            <label for="menu">匯入菜單( 複製菜單 )</label>
            <select class="form-control" id="copy">
                <option value="-1">不匯入</option>
                @for($i=0; $i<count($menuData); $i++)
                <option value="{{$menuData[$i]['id']}}">{{$menuData[$i]['name']}}</option>
                @endfor
            </select>
        </div>
        <div class="row">
            <label for="period">期號</label>
            <select class="form-control" id="period">
                <option disabled>期號</option>
                @for($i=0; $i<count($periodData); $i++)
                <option value="{{$periodData[$i]['id']}}">{{$periodData[$i]['name']}}</option>
                @endfor
            </select>
        </div>
        <br>
        <div class="row text-right">
            <button class="btn btn-primary" id="addModalBtn">新增商品</button>
        </div>
        <table class="table table-striped" id="menuTable">
            <thead>
                <tr>
                    <th>名稱</th>
                    <th>單位</th>
                    <th>庫存</th>
                    <th>價錢</th>
                    <th>描述</th>
                    <th>#</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
        <div class="row text-center">
            <button type="button" class="btn btn-danger" onclick="window.location='{{url('menuManager/menu')}}'">不修改，直接回到菜單列表</button>
            <button type="button" class="btn btn-primary" id="addMenuBtn">確認，新增菜單</button>
        </div>
    </div>
@stop

