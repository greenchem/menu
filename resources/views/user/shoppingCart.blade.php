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

<div class="container">
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
            <button class="btn btn-primary">確定送出</button>
        </div>
    </div><!-- row -->
</div><!-- container -->
@stop

