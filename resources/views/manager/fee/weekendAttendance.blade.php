@extends('init')

@section('css')
    <title>津貼系統 - 假日值班</title>
    <link rel="stylesheet" href="{{url('assets/css/manager/fee.css')}}">
@stop

@section('js')
    <script src="{{url('assets/js/manager/fee/weekendAttendance.js')}}"></script>
@stop

@section('content')
    @include('manager.header')
<div class="container">
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-3"></div>
        <div class="col-lg-9 col-md-9 col-sm-9 text-center">
            <h3>津貼系統 - 週末值班津貼</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-3" id="menuListBG">
            <div class="btn-group-vertical" role="group" id="menuList">
            <button type="button" class="btn btn-default"
onclick="window.location = '{{url('manager/fee/meal')}}'">伙食</button>
<button type="button" class="btn btn-default"
onclick="window.location = '{{url('manager/fee/dorm')}}'">住宿</button>
<button type="button" class="btn btn-default"
onclick="window.location = '{{url('manager/fee/parking')}}'">停車費</button>
<button type="button" class="btn btn-default"
onclick="window.location = '{{url('manager/fee/attendance')}}'">值班</button>
<button type="button" class="btn btn-default active"
onclick="window.location = '{{url('manager/fee/weekendAttendance')}}'">假日值班</button>
            </div>
        </div>

        <div id="feeContentDiv" class="col-lg-9 col-md-9 col-sm-9">
            <ul id="feeClassBG" class="nav nav-tabs">
                <li role="presentation" class="active uploadFileDiv"><a href="#">匯入</a></li>
                <li role="presentation" class="outputFileDiv"><a href="#">匯出</a></li>
                <li role="presentation" class="manageDiv"><a href="#">管理</a></li>
            </ul>
            <div class="feeContent text-center uploadFileDiv" >
                <input class="form-control" type="file"></input>
                <button type="button" class="btn btn-primary">上傳</button>
            </div>


            <div class="feeContent text-center outputFileDiv" >
                <select class="form-control">
    ¦   ¦   ¦   ¦   <option disabled>公司</option>
    ¦   ¦   ¦   ¦   @for($j=0; $j<10; $j++)
    ¦   ¦   ¦   ¦       <option value="{{$j}}">嘉良特化</option>
    ¦   ¦   ¦   ¦   @endfor
    ¦   ¦   ¦   </select>
                <select class="form-control">
    ¦   ¦   ¦   ¦   <option disabled>單位</option>
    ¦   ¦   ¦   ¦   @for($j=0; $j<10; $j++)
    ¦   ¦   ¦   ¦       <option value="{{$j}}">人事部</option>
    ¦   ¦   ¦   ¦   @endfor
                </select>
                <select class="form-control">
    ¦   ¦   ¦   ¦   <option disabled>員工</option>
    ¦   ¦   ¦   ¦   @for($j=0; $j<10; $j++)
    ¦   ¦   ¦   ¦       <option value="{{$j}}">江XX (A123123123)</option>
    ¦   ¦   ¦   ¦   @endfor
                </select>

                <input type="date" class="form-control"/>
                <input type="date" class="form-control"/>
                <button type="button" class="btn btn-primary">匯出</button>
            </div>

            <div class="feeContent text-center manageDiv" >
                <select class="form-control">
    ¦   ¦   ¦   ¦   <option disabled>公司</option>
    ¦   ¦   ¦   ¦   @for($j=0; $j<10; $j++)
    ¦   ¦   ¦   ¦       <option value="{{$j}}">嘉良特化</option>
    ¦   ¦   ¦   ¦   @endfor
    ¦   ¦   ¦   </select>
                <select class="form-control">
    ¦   ¦   ¦   ¦   <option disabled>單位</option>
    ¦   ¦   ¦   ¦   @for($j=0; $j<10; $j++)
    ¦   ¦   ¦   ¦       <option value="{{$j}}">人事部</option>
    ¦   ¦   ¦   ¦   @endfor
                </select>
                <select class="form-control">
    ¦   ¦   ¦   ¦   <option disabled>員工</option>
    ¦   ¦   ¦   ¦   @for($j=0; $j<10; $j++)
    ¦   ¦   ¦   ¦       <option value="{{$j}}">江XX (A123123123)</option>
    ¦   ¦   ¦   ¦   @endfor
            </select><br/>
                <table class="table table-striped text-center" id="menuTable" >
                    <thead>
                        <tr align=center>
                            <th>員工</th>
                            <th>時間</th>
                            <th>金錢</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for($i=0; $i<5; $i++)
                            <tr>
                                <td>江XX</td>
                                <td>2016/03/05 08:00 - 2016/03/05 17:00</td>
                                <td>10000000000000000</td>
                                <td>
                                    <button type="button" class="btn btn-danger">刪除</button>
                                </td>
                            </tr>
                            @endfor
                    </tbody>
                </table>
                <button type="button" class="btn btn-primary">新增款項</button>
            </div>
        </div> <!-- col-lg-9 -->
    </div><!-- row -->
</div><!-- container -->
@stop

