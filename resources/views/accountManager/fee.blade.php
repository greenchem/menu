@extends('init')

@section('css')
<title>帳號系統</title>
<link rel="stylesheet" href="{{url('assets/css/accountManager/fee.css')}}">
@stop

@section('js')
    <script src="{{url('assets/js/accountManager/fee.js')}}"></script>
@stop

@section('content')
    @include('accountManager.header')

    <div class="container">
        <div class="row">
            <br/>
            <label for="feeType">津貼類型</label>
            <select class="form-control" id="feeType">
                <option value="meal_logs">伙食</option>
                <option value="dorm_logs">住宿</option>
                <option value="attendance_logs">值班</option>
                <option value="weekend_logs">假日值班</option>
                <option value="parking_logs">停車費</option>
            </select>

            <br/>
            <label for="yearSelect">年</label>
            <select class="form-control" id="yearSelect">
            </select>

            <br/>
            <label for="monthSelect">月/季</label>
            <select class="form-control" id="monthSelect">
                <option class="month hide" value="1">1 月</option>
                <option class="month hide" value="2">2 月</option>
                <option class="month hide" value="3">3 月</option>
                <option class="month hide" value="4">4 月</option>
                <option class="month hide" value="5">5 月</option>
                <option class="month hide" value="6">6 月</option>
                <option class="month hide" value="7">7 月</option>
                <option class="month hide" value="8">8 月</option>
                <option class="month hide" value="9">9 月</option>
                <option class="month hide" value="10">10 月</option>
                <option class="month hide" value="11">11 月</option>
                <option class="month hide" value="12">12 月</option>
                <option class="quarter hide" value="1">第一季</option>
                <option class="quarter hide" value="2">第二季</option>
                <option class="quarter hide" value="3">第三季</option>
                <option class="quarter hide" value="4">第四季</option>
            </select>

            <br/>
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
            </select>
        </div>


        <table class="table table-striped" align=center id="accountTable">
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
        </table>
    </div>
@stop

