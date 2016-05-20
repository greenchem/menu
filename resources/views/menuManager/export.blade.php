@extends('init')

@section('css')
    <title>菜單系統 - 報表匯出</title>
@stop

@section('js')
<script src="{{url('assets/js/menuManager/export.js')}}"></script>
@stop

@section('content')
    @include('menuManager.header')
    <div class="container">
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
            <label for="type">報表類型</label>
            <select class="form-control" id="type">
                <option disabled>報表類型</option>
                <option value="stocking_form">備貨單</option>
                <option value="accounting_form">核銷單</option>
            </select>
        </div>
        <br>
        <div class="row text-center">
            <button id="exportBtn" class="btn btn-primary">匯出</button>
        </div>
    </div>
@stop

