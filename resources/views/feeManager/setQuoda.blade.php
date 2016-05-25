@extends('init')

@section('css')
    <title>津貼系統</title>
    <link rel="stylesheet" href="{{url('assets/css/feeManager/setQuoda.css')}}">
@stop

@section('content')
    @include('feeManager.header')

    <div class="container">
        <h1 class="text-center">津貼系統 - 購物津貼</h1>
        <br/>
        <div id="readyToCreate" class="row">
            <table class="accountTable table table-striped" align=center>
                <thead>
                <tr>
                    <th>帳號</th>
                    <th>姓名</th>
                    <th>公司</th>
                    <th>單位</th>
                    <th>職等</th>
                    <th>購物津貼</th>
                </tr>
                </thead>
                <tbody class="quodaContent text-center">
                </tbody>
            </table>

            <div id="checkCreateBtnDiv" class="row text-center">
                <button type="button" id="checkCreateBtn" class="btn btn-danger">確定新增</button>
            </div>
        </div>

        <div id="userInput" class="row">
            <br/>
            <div class="row">
                <label for="period">期號</label>
                <select class="form-control" id="period">
                    <option disabled>期號</option>
                    @for($i=0; $i<count($periodData); $i++)
                        <option value="{{$periodData[$i]['id']}}">{{$periodData[$i]['name']}}</option>
                    @endfor
                </select>
            </div>

            <br/>
            <div class="row">
                <label for="companySelect">公司名稱</label>
                <select class="form-control" id="companySelect">
                    @for($i=0; $i<count($companyData); $i++)
                        <option value="{{$companyData[$i]['id']}}">{{$companyData[$i]['name']}}</option>
                    @endfor
                </select>
            </div>

            <br/>
            <div class="row">
                <label for="groupSelect">單位名稱</label>
                <select class="form-control" id="groupSelect">
                    @for($i=0; $i<count($groupData); $i++)
                        <option class="hide" value="{{$groupData[$i]['id']}}" data-company_id="{{$groupData[$i]['company_id']}}">{{$groupData[$i]['name']}}</option>
                    @endfor
                </select>
            </div>

            <br/>
            <div class="row">
                <table class="table table-striped" align=center id="accountTable">
                    <thead>
                    <tr>
                        <th>帳號</th>
                        <th>姓名</th>
                        <th>公司</th>
                        <th>單位</th>
                        <th>職等</th>
                        <th>購物津貼</th>
                    </tr>
                    </thead>
                    <tbody id="accountContent" class="text-center">
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@stop
@section('js')
    <script src="{{url('assets/js/feeManager/setQuoda.js')}}"></script>
@stop

