@extends('init')

@section('css')
<title>菜單系統 - 編輯菜單</title>
@stop

@section('js')
<script src="{{url('assets/js/menuManager/edit.js')}}"></script>
@stop

@section('content')
    @include('menuManager.header')
    @include('menuManager.addModal')
    @include('menuManager.editModal')

    <input type="hidden" value="{{url('')}}" id="url">
    <input type="hidden" value="{{$menuData['id']}}" id="menu_id">
    <input type="hidden" id="currentEditId">
    <input type="hidden" id="currentEditType">

    <h3 class="text-center">編輯菜單</h3>
    <div class="container">
        <div class="row">
            <label for="menuName">菜單名稱</label>
            <input type="text" class="form-control" id="menuName" value="{{$menuData['name']}}" disabled>
        </div>
        <div class="row">
            <label for="period">期號</label>
            <input type="text" class="form-control"
                @for($i=0; $i<count($periodData); $i++)
                    @if($periodData[$i]['id'] == $menuData['period_id'])
                    value="{{$periodData[$i]['name']}}"
                    @endif
                @endfor
            id="period" disabled>
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
                    <th>數量</th>
                    <th>價錢</th>
                    <th>描述</th>
                    <th>#</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
        <div class="row text-center">
            <button type="button" class="btn btn-danger" onclick="window.location='{{url('menuManager/menu')}}'">不修改，直接回到菜單列表</button>
            <button type="button" class="btn btn-primary" id="editMenuBtn">確認，修改菜單</button>
        </div>
    </div>
@stop

