@extends('init')

@section('css')
<title>帳號系統</title>
@stop

@section('js')
<script src="{{url('assets/js/manager/account.js')}}"></script>
@stop

@section('content')
    @include('manager.header')
    <div class="container">
        <div class="row">
            <br>

            <div class="col-lg-12 text-right">
                <button class="btn btn-primary">新增人員</button>
            </div>
        </div>
        <table class="table table-striped" id="menuTable">
            <thead>
                <tr>
                    <th>編號</th>
                    <th>姓名</th>
                    <th>公司</th>
                    <th>單位</th>
                    <th>#</th>
                </tr>
            </thead>
            <tbody>
                @for($i=0; $i<5; $i++)
                <tr>
                    <td>{{md5($i)}}</td>
                    <td>柯XX</td>
                    <td>嘉良特化</td>
                    <td>人事部</td>
                    <td>
                        <button class="btn btn-primary">編輯</button>
                        <button class="btn btn-danger">刪除</button>
                    </td>
                </tr>
                @endfor
            </tbody>
        </table>
    </div>
@stop

