@extends('init')

@section('css')
<title>管理菜單</title>
<link rel="stylesheet" href="{{url('assets/css/manager/menu.css')}}">
@stop

@section('js')

@stop

@section('content')
    @include('manager.header')

    <input type="hidden" id="currentMenu">

    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3"></div>
            <div class="col-lg-9 col-md-9 col-sm-9 text-center">
                <h3>春節菜單</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3">
                <ul class="nav nav-pills nav-stacked">
                    <li role="presentation" class="active"><a href="#">春節菜單</a></li>
                    <li role="presentation"><a href="#">端午菜單</a></li>
                </ul>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-9">
                <table class="table table-striped" id="menuTable">
                    <thead>
                        <tr>
                            <th>名稱</th>
                            <th>單位</th>
                            <th>數量</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for($i=0; $i<5; $i++)
                        <tr>
                            <td>百事可樂</td>
                            <td>瓶</td>
                            <td>1</td>
                        </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3"></div>
            <div class="col-lg-9 col-md-9 col-sm-9 text-center">
                <button class="btn btn-primary edit" onclick="window.location='{{url('manager/menu/edit/1')}}'">編輯</button>
                <button class="btn btn-danger">刪除</button>
            </div>
        </div>
    </div>
@stop

