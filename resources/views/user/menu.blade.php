@extends('init')

@section('css')
<title>禮品清單</title>
<link rel="stylesheet" href="{{url('assets/css/user/menu.css')}}">
@stop

@section('js')
<script src="{{url('assets/js/user/menu.js')}}"></script>
@stop

@section('content')

@include('user.header')
<div class="container">
    <div class="row">
        <h3><span id="nickname">{{Auth::user()->nickname}}</span> 所剩下的quota：<span id="quota"></span>元</h3>
    </div>
  <div class="row">
    <div class="btn-group" role="group">
        @for($i=0; $i<count($companyData); $i++)
        <button type="button" class="btn btn-default companyList" data-company="{{$companyData[$i]['id']}}">
        {{$companyData[$i]['name']}}
        </button>
        @endfor
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
        <tbody></tbody>
      </table>
    </div> <!-- col-lg-9 -->
  </div><!-- row -->
  <div class="row">
    <div class="col-lg-3 col-md-3 col-sm-3"></div>
    <div class="col-lg-9 col-md-9 col-sm-9 text-center">
      <button class="btn btn-primary" id="shoppingCartBtn">加入購物車</button>
    </div>
  </div><!-- container -->
@stop

