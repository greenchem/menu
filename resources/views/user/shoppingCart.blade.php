@extends('init')

@section('css')
<title>禮品清單</title>
<link rel="stylesheet" href="{{url('assets/css/user/shoppingCart.css')}}">
@stop

@section('js')
<script src="{{url('assets/js/user/shoppingCart.js')}}"></script>
@stop

@section('content')

@include('user.header')

<input type="hidden" value="{{$paid}}" id="paid">
<input type="hidden" value="{{$currentQuota}}" id="currentQuota">
<input type="hidden" value="{{$currentPeriod}}" id="currentPeriod">

<div class="container">

@if($currentPeriod == -1)

<h1>目前沒有開放任何菜單</h1>

@else
    <div class="row">
        <h3><span id="nickname">{{Auth::user()->nickname}}</span> 所剩下的quota：<span id="quota"></span>元</h3>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-striped" id="productTable">
                <thead>
                    <tr>
                        <th>名稱</th>
                        <th>單位</th>
                        <th>金額</th>
                        <th>數量</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div> <!-- col-lg-12 -->
        <div class="col-lg-12 text-center">
            <button class="btn btn-primary" id="submitBtn">確定送出</button>
        </div>
    </div><!-- row -->
@endif

</div><!-- container -->

@stop

