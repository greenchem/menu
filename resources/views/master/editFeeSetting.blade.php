@extends('init')

@section('css')
    <title>帳號系統</title>
    <link rel="stylesheet" href="{{url('assets/css/master/editFeeSetting.css')}}">
@stop

@section('js')
    <script src="{{url('assets/js/master/editFeeSetting.js')}}"></script>
@stop

@section('content')
    @include('master.header')

    <div class="container">
        <h1 class="text-center">設定津貼編輯權限</h1>
        <div class="row">
            <br/>
            <label for="feeType">津貼類型</label>
            <select class="form-control" id="feeType">
                <option value="meal">伙食</option>
                <option value="dorm">住宿</option>
                <option value="attendance">值班</option>
                <option value="weekend">假日值班</option>
                <option value="parking">停車費</option>
            </select>

            <br/>
            <label for="yearSelect">年</label>
            <select class="form-control" id="yearSelect">
            </select>

            <br/>
            <label for="monthSelect">月/季</label>
            <select class="form-control" id="monthSelect">
                <option class="month hide" value="01">1 月</option>
                <option class="month hide" value="02">2 月</option>
                <option class="month hide" value="03">3 月</option>
                <option class="month hide" value="04">4 月</option>
                <option class="month hide" value="05">5 月</option>
                <option class="month hide" value="06">6 月</option>
                <option class="month hide" value="07">7 月</option>
                <option class="month hide" value="08">8 月</option>
                <option class="month hide" value="09">9 月</option>
                <option class="month hide" value="10">10 月</option>
                <option class="month hide" value="11">11 月</option>
                <option class="month hide" value="12">12 月</option>
                <option class="quarter hide" value="1~3">第一季</option>
                <option class="quarter hide" value="4~6">第二季</option>
                <option class="quarter hide" value="7~9">第三季</option>
                <option class="quarter hide" value="10~12">第四季</option>
            </select>

            <!--<br/>
            <label for="companySelect">公司名稱</label>
            <select class="form-control" id="companySelect">
                @for($i=0; $i<count($companyData); $i++)
                    <option value="{{$companyData[$i]['id']}}">{{$companyData[$i]['name']}}</option>
                @endfor
            </select>

            <br/>
            <label for="groupSelect">單位名稱</label>
            <select class="form-control" id="groupSelect">
                @for($i=0; $i<count($groupData); $i++)
                    <option class="hide" value="{{$groupData[$i]['id']}}" data-company_id="{{$groupData[$i]['company_id']}}">{{$groupData[$i]['name']}}</option>
                @endfor
            </select>-->
            <br/><br/><br/>
            <div class="text-center">
                <button type="button" class="createFeePermissionBtn btn btn-primary">開啟津貼編輯權限</button>
            </div>
        </div>


        <!--<table class="table table-striped" align=center id="accountTable">
            <thead>
                <tr>
                    <th>帳號</th>
                    <th>姓名</th>
                    <th>公司</th>
                    <th>單位</th>
                    <th>職等</th>
                    <th>#</th>
                </tr>
            </thead>
            <tbody id="accountContent" class="text-center">
            </tbody>
        </table>-->
    </div>
@stop

