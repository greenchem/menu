@extends('init')

@section('css')
<title>禮品清單</title>
<link rel="stylesheet" href="{{url('assets/css/user/shoppingCart.css')}}">
@stop

@section('js')
<script src="{{url('assets/js/user/history.js')}}"></script>
@stop

@section('content')
@include('user.header')

<input type="hidden" value="{{Auth::user()->id}}" id="user_id">

<div class="container">
    <div class="row">
        <label for="period">期號</label>
        <select class="form-control" id="period">
        @for($i=0; $i<count($periodData); $i++)
        <option value="{{$periodData[$i]['id']}}">{{$periodData[$i]['name']}}</option>
        @endfor
        </select>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-striped" id="menuTable">
                <thead>
                    <tr>
                        <th>名稱</th>
                        <th>單位</th>
                        <th>數量</th>
                        <th>金額</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div> <!-- col-lg-12 -->
    </div><!-- row -->
</div>

@stop
