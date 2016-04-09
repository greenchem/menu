@extends('init')

@section('css')
<title>禮品清單</title>
<link rel="stylesheet" href="{{url('assets/css/user/shoppingCart.css')}}">
@stop

@section('js')
@stop

@section('content')
@include('user.header')

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-striped" id="menuTable">
                <thead>
                    <tr>
                        <th>名稱</th>
                        <th>單位</th>
                        <th>數量</th>
                        <th>金額</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
                        @for($i=0; $i<5; $i++)
                        <tr>
                            <td>百事可樂</td>
                            <td>瓶</td>
                            <td>1</td>
                            <td>100</td>
                            <td><button type="button" class="btn btn-warning" disabled>未核銷</button></td>
                        </tr>
                        @endfor
                        <tr>
                            <td>百事可樂</td>
                            <td>瓶</td>
                            <td>1</td>
                            <td>100</td>
                            <td><button type="button" class="btn btn-success" disabled>已銷帳</button></td>
                        </tr>
                </tbody>
                </table>
            </div> <!-- col-lg-12 -->
        </div><!-- row -->
</div>

@stop
