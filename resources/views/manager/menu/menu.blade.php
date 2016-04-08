@extends('init')

@section('css')
<title>菜單 - 菜單系統</title>
@stop

@section('js')

@stop

@section('content')
    @include('manager.header')

    <input type="hidden" id="currentMenu">

    <h3 class="text-center">春節菜單</h3>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3">
                <ul class="nav nav-pills nav-stacked">
                    <li role="presentation" class="active"><a href="#">春節菜單</a></li>
                    <li role="presentation"><a href="#">端午菜單</a></li>
                </ul>
            </div>
            <div class="col-lg-7 col-md-7 col-sm-7">
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
    </div>
@stop

