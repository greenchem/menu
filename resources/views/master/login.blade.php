@extends('init')

@section('css')
<title>管理者登入</title>
@stop

@section('js')
@stop

@section('content')
<div class="container">
    <div class="row">
        <label for="account">帳號</label>
        <input type="text" class="form-control" id="account">
    </div>
    <div class="row">
        <label for="password"></label>
        <input class="form-control" type="text" id="password">
    </div>
    <div class="row text-center">
        <button class="btn btn-primary">登入</button>
    </div>
</div>
@stop

