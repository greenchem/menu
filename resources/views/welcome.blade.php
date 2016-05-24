@extends('init')

@section('css')
    <title>入口</title>
    <link rel="stylesheet" href="{{url('assets/css/welcome.css')}}">
@stop

@section('js')
    <script src="{{url('assets/js/welcome.js')}}"></script>
@stop

@section('content')
    <div class="container">
        <div class="content">
          <div class="title">嘉良特化 - 暫時入口</div>
        </div>
        <div class="container">
            @if(Auth::check())
                <p><a href="{{url('user/menu')}}">一般使用者系統</a></p>
                <p><a href="{{url('menuManager/menu')}}">菜單管理系統</a></p>
                <p><a href="{{url('accountManager/account')}}">帳號管理系統</a></p>
                <p><a href="{{url('feeManager/meal')}}">津貼管理系統</a></p>
                <p><a href="{{url('master/')}}">最高管理者系統</a></p>
            @else
                <div class="form-signin">
                    <h2 class="form-signin-heading">登入</h2>
                    <label for="username" class="sr-only">Email address</label>
                    <input type="text" id="username" class="form-control" placeholder="帳號" required autofocus="">
                    <label for="password" class="sr-only">Password</label>
                    <input type="password" id="password" class="form-control" placeholder="密碼" required>
                    <button id="loginBtn" class="btn btn-lg btn-primary btn-block" type="submit">登入</button>
                </div>
            @endif
        </div>
    </div>
@stop
