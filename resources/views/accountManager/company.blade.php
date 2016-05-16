@extends('init')

@section('css')
<title>公司部門設定</title>
@stop

@section('js')
    <script src="{{url('assets/js/accountManager/company.js')}}"></script>
@stop

@section('content')
    @include('accountManager.header')

    <div id="addCompanyContainer" class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3"></div>
            	<div class="text-center">
                	<h3>帳號系統</h3>
            	</div>
            </div>


        <div id="feeContentDiv" >
            <ul id="feeClassBG" class="nav nav-tabs">
              <li role="presentation" class="active addRecordDiv"><a href="#">公司</a></li>
                <li role="presentation" class="manageDiv"><a href="#">部門</a></li>
            </ul>

            <div class="feeContent addRecordDiv" >
                <div class="row">
                    <div class="col-lg-12 text-right">
                        <button type="button" class="btn btn-primary " align=center data-toggle="modal" data-target="#companyModal" align=center>新增公司</button>
                    </div>
                    <table class="table table-striped" align=center id="addTable">
                        <thead>
                            <tr>
                                <th>公司</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @for($i=0; $i<count($companyData); $i++)
                            <tr>
                                <td>{{$companyData[$i]['name']}}</td>
                                <td data-companyid="{{$companyData[$i]['id']}}" data-companyname="{{$companyData[$i]['name']}}">
                                    <button type="button" class="editCompany btn btn-primary" data-toggle="modal" data-target="#editCompanyModal">修改</button>
                                    <button type="button" class="deleteCompany btn btn-danger" data-toggle="modal" data-target="#deleteCompanyModal">刪除</button>
                                </td>
                            </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>


            <div class="feeContent manageDiv">
                <div class="row">
                    <div class="col-lg-12 text-right">
                        <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#groupModal">新增部門</button>
                    </div>
                    <table class="table table-striped" id="editTable">
                        <thead>
                            <tr>
                                <th>公司</th>
                                <th>部門</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @for($i=0; $i<count($groupData); $i++)
                                <tr>
                                    <td>{{$groupData[$i]['company']['name']}}</td>
                                    <td>{{$groupData[$i]['name']}}</td>
                                    <td data-groupid="{{$groupData[$i]['id']}}" data-groupname="{{$groupData[$i]['name']}}" data-companyid="{{$groupData[$i]['company_id']}}" data-companyname="{{$groupData[$i]['company']['name']}}">
                                        <button type="button" class="editGroup btn btn-primary" data-toggle="modal" data-target="#editGroupModal">修改</button>
                                        <button type="button" class="deleteGroup btn btn-danger"  data-toggle="modal" data-target="#deleteGroupModal">刪除</button>
                                    </td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!-- row -->



        <!-- addCompany Modal -->
        <div id="companyModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">新增公司</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <label for="addCompany-companyName">公司名稱</label>
                            <input type="text" class="form-control" id="addCompany-companyName">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="addCompanyButton" type="button" class="btn btn-primary">新增</button>
                    </div>
                </div>
                <!-- end content -->
            </div>
        </div>
        <!-- end modal -->



        <!-- editCompany Modal -->
        <div id="editCompanyModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">修改公司</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <label for="editCompany-companyName">公司名稱</label>
                            <input type="text" class="form-control" id="editCompany-companyName">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="checkEditCompanyButton" type="button" class="btn btn-primary">修改</button>
                    </div>
                </div>
                <!-- end content -->
            </div>
        </div>
        <!-- end modal -->

        <!-- deleteCompany Modal -->
        <div id="deleteCompanyModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h1 class="modal-title">刪除公司</h1>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <h3 class="modal-title">
                                <span>公司名稱：</span>
                                <span class="companyName"></span>
                            </h3>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="checkDeleteCompanyButton" type="button" class="btn btn-danger">刪除</button>
                    </div>
                </div>
                <!-- end content -->
            </div>
        </div>
        <!-- end modal -->






        <!-- addGroup Modal -->
        <div id="groupModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">新增部門</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <label for="addGroup-companyName">公司名稱</label>
                            <select class="form-control" id="addGroup-companyName">
                                @for($i=0; $i<count($companyData); $i++)
                                    <option value="{{$companyData[$i]['id']}}">{{$companyData[$i]['name']}}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="row">
                            <label for="addGroup-groupName">部門名稱</label>
                            <input type="text" class="form-control" id="addGroup-groupName">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="addGroupButton" type="button" class="btn btn-primary">新增</button>
                    </div>
                </div>
                <!-- end content -->
            </div>
        </div>
        <!-- end modal -->


        <!-- editGroup Modal -->
        <div id="editGroupModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">修改部門</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <label for="editGroup-companyName">公司名稱</label>
                            <select class="form-control" id="editGroup-companyName">
                                @for($i=0; $i<count($companyData); $i++)
                                    <option value="{{$companyData[$i]['id']}}">{{$companyData[$i]['name']}}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="row">
                            <label for="editGroup-groupName">部門名稱</label>
                            <input type="text" class="form-control" id="editGroup-groupName">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="checkEditGroupButton" type="button" class="btn btn-primary">修改</button>
                    </div>
                </div>
                <!-- end content -->
            </div>
        </div>
        <!-- end modal -->


        <!-- deleteGroup Modal -->
        <div id="deleteGroupModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h1 class="modal-title">刪除部門</h1>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <h3>
                                <span>公司名稱：</span>
                                <span class="companyName"></span>
                            </h3>

                            <h3 class="modal-title">
                                <span>部門名稱：</span>
                                <span class="groupName"></span>
                            </h3>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="checkDeleteGroupButton" type="button" class="btn btn-danger">刪除</button>
                    </div>
                </div>
                <!-- end content -->
            </div>
        </div>
        <!-- end modal -->

    </div><!-- container -->
@stop

