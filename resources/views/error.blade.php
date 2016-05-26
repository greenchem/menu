@extends('init')
@section('css')
<title>錯誤頁面</title>
@stop

@section('content')
<div class="container">
    <h1>您權限不足</h1>
    <ul>
        <li>一般使用者</li>
        <li>菜單管理者</li>
        <li>津貼管理者</li>
        <li>帳號管理者</li>
        <li>最高管理者</li>
    </ul>
    <h1>這5個分別對應5個系統請不要亂按</h1>
    <h1>點擊<b><a href="{{url('/')}}">這裡</a></b>回首頁</h1>
    <h1>您可以在回首頁之後選擇你有權限的系統，或是登出後輸入有權限的帳號重新登入</h1>
</div>
@stop
