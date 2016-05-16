@extends('init')

@section('css')
    <title>公司部門設定</title>
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
                <p><a href="{{url('user/menu')}}">使用者</a></p>
                <p><a href="{{url('menuManager/menu')}}">菜單管理者</a></p>
                <p><a href="{{url('accountManager/account')}}">帳號管理者</a></p>
                <p><a href="{{url('feeManager/parking')}}">津貼管理者</a></p>
                <p><a href="{{url('master/')}}">最高管理者</a></p>
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