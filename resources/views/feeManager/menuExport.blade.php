@extends('init')

@section('css')
    <title>津貼系統 - 報表匯出</title>
@stop


@section('content')
    @include('feeManager.header')
    <h1 class="text-center">所有公司禮品報表匯出</h1>
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

        <div class="row text-center">
            <button id="exportBtn" class="btn btn-primary">匯出</button>
        </div>
    </div>
@stop

@section('js')
    <script src="{{url('assets/js/feeManager/menuExport.js')}}"></script>
@stop