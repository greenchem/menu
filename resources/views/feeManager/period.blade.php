@extends('init')

@section('css')
<title>菜單相關設定</title>
@stop

@section('js')
<script src="{{url('assets/js/feeManager/period.js')}}"></script>
@stop

@section('content')
    @include('feeManager.header')
    @include('feeManager.period.addPeriod')
    @include('feeManager.period.editPeriod')

    <input type="hidden" id="currentEditId">

    <div class="container">

        <div class="row">
            <h4 style="color:red;">一次只能有 <b>一個期號</b> 開啟</h4>
        </div>
      <div class="row text-right">
        <button id="addModalBtn" class="btn btn-primary">新增期號</button>
      </div>
      <div class="row">
        <table class="table table-striped" id="periodTable">
          <thead>
            <tr>
              <th>期號名稱</th>
              <th>狀態</th>
              <th>#</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
    </div>
@stop

