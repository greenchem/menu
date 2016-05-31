@extends('init')

@section('css')
<title>修改密碼</title>
@stop

@section('js')
<script src="{{url('assets/js/user/password.js')}}"></script>
@stop

@section('content')
@include('user.header')

<input type="hidden" value="{{Auth::user()->id}}" id="user_id">

<div class="container">
    <div class="row">
        <label for="password">密碼</label>
        <input type="text" class="form-control" id="password">
    </div>
    <br>
    <div class="row text-center">
        <button class="btn btn-primary" id="passwordBtn">修改密碼</button>
    </div>
</div>

@stop
