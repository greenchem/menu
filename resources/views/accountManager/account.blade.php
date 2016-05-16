@extends('init')

@section('css')
<title>帳號系統</title>
<link rel="stylesheet" href="{{url('assets/css/accountManager/addCompanyGroup.css')}}">
@stop

@section('js')
<script src="{{url('assets/js/accountManager/account.js')}}"></script>
@stop

@section('content')
    @include('accountManager.header')
    @include('accountManager.account.addModal')
    @include('accountManager.account.editModal')
    @include('accountManager.account.roleModal')

    <input type="hidden" id="currentEditId">
    <div class="container">
        <div class="row">
            <br>

            <div class="col-lg-12 text-right">
                <button class="btn btn-primary" id="addModalBtn">新增帳號</button>
            </div>
        </div>
        <table class="table table-striped" id="menuTable">
            <thead>
                <tr>
                    <th>帳號</th>
                    <th>姓名</th>
                    <th>公司</th>
                    <th>單位</th>
                    <th>#</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
        <nav class="text-center">
            <ul class="pagination"></ul>
        </nav>
    </div>
@stop

