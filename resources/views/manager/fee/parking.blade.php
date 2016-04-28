@extends('init')

@section('css')
<title>津貼系統 - 停車</title>
<link rel="stylesheet" href="{{url('assets/css/manager/fee.css')}}">
@stop

@section('js')
<script src="{{url('assets/js/manager/fee/parking.js')}}"></script>
@stop

@section('content')
    @include('manager.header')
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3"></div>
            <div class="col-lg-9 col-md-9 col-sm-9 text-center">
                <h3>津貼系統 - 停車津貼</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3" id="menuListBG">
                <div class="btn-group-vertical" role="group" id="menuList">
                    <button type="button" class="btn btn-default"
onclick="window.location = '{{url('manager/fee/meal')}}'">伙食</button>
<button type="button" class="btn btn-default"
onclick="window.location = '{{url('manager/fee/dorm')}}'">住宿</button>
<button type="button" class="btn btn-default active"
onclick="window.location = '{{url('manager/fee/parking')}}'">停車費</button>
<button type="button" class="btn btn-default"
onclick="window.location = '{{url('manager/fee/attendance')}}'">值班</button>
<button type="button" class="btn btn-default"
onclick="window.location = '{{url('manager/fee/weekendAttendance')}}'">假日值班</button>
            </div>
        </div>

        <div id="feeContentDiv" class="col-lg-9 col-md-9 col-sm-9">
            <ul id="feeClassBG" class="nav nav-tabs">
              <li role="presentation" class="active addRecordDiv"><a href="#">新增</a></li>
                <li role="presentation" class="manageDiv"><a href="#">管理</a></li>
            </ul>
            <div class="feeContent addRecordDiv" >
                <div class="row">
                  <label for="addYear">年</label>
                  <select class="form-control" id="addYear">
                    <option disabled>年</option>
                    <option value="2015">2015</option>
                    <option value="2016">2016</option>
                  </select>
                </div>
                <div class="row">
                  <label for="addSeason">季</label>
                  <select class="form-control" id="addSeason">
                    <option disabled>季</option>
                    <option value="1-3">1-3月</option>
                    <option value="3-6">3-6月</option>
                    <option value="6-9">6-9月</option>
                    <option value="9-12">9-12月</option>
                  </select>
                </div>
                <div class="row">
                  <label for="addCompany">公司</label>
                  <select id="addCompany" class="form-control">
                    <option disabled>公司</option>
                    <option value="">嘉良</option>
                    <option value="">良農</option>
                    <option value="">優好</option>
                  </select>
                </div>
                <div class="row">
                  <label for="addGroup">部門</label>
                  <select id="addGroup" class="form-control">
                    <option disabled>部門</option>
                    <option value="">人事部</option>
                    <option value="">經濟部</option>
                    <option value="">外交部</option>
                  </select>
                </div>
                <div class="row">
                  <table class="table table-striped" id="addTable">
                    <thead>
                      <tr>
                        <th>員工ID</th>
                        <th>員工姓名</th>
                        <th>金額</th>
                      </tr>
                    </thead>
                    <tbody></tbody>
                  </table>
                </div>

                <button type="button" class="btn btn-primary" id="addBtn">新增</button>
            </div>

            <div class="feeContent manageDiv">
                <div class="row">
                  <label for="addYear">年</label>
                  <select class="form-control" id="editYear">
                    <option disabled>年</option>
                    <option value="2015">2015</option>
                    <option value="2016">2016</option>
                  </select>
                </div>
                <div class="row">
                  <label for="addSeason">季</label>
                  <select class="form-control" id="editSeason">
                    <option disabled>季</option>
                    <option value="1-3">1-3月</option>
                    <option value="3-6">3-6月</option>
                    <option value="6-9">6-9月</option>
                    <option value="9-12">9-12月</option>
                  </select>
                </div>
                <div class="row">
                  <label for="editCompany">公司</label>
                  <select id="editCompany" class="form-control">
                    <option disabled>公司</option>
                    <option value="">嘉良</option>
                    <option value="">良農</option>
                    <option value="">優好</option>
                  </select>
                </div>
                <div class="row">
                  <label for="editGroup">部門</label>
                  <select id="editGroup" class="form-control">
                    <option disabled>部門</option>
                    <option value="">人事部</option>
                    <option value="">經濟部</option>
                    <option value="">外交部</option>
                  </select>
                </div>
                <div class="row">
                  <table class="table table-striped" id="editTable">
                    <thead>
                      <tr>
                        <th>員工ID</th>
                        <th>員工姓名</th>
                        <th>金額</th>
                        <th>#</th>
                      </tr>
                    </thead>
                    <tbody></tbody>
                  </table>
                </div>
              <button type="button" class="btn btn-primary" id="editBtn">確認修改</button>
            </div>
            </div> <!-- col-lg-9 -->
        </div><!-- row -->
    </div><!-- container -->
@stop

