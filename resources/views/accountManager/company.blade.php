@extends('init')

@section('css')
<title>帳號系統</title>
<link rel="stylesheet" href="{{url('assets/css/feeManager/fee.css')}}">
@stop

@section('js')
<script src="{{url('assets/js/accountManager/company.js')}}"></script>
@stop

@section('content')
    @include('accountManager.header')
    
    
    <div class="container">
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
                        <th>公司ID</th>
                        <th>公司</th>
			<th>#</th>                 
                      </tr>
                    </thead>
                    <tbody class="text-center"></tbody>
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
                    <tbody class="text-center"></tbody>
                  </table>
                </div>
               
            </div>
            </div> <!-- col-lg-9 -->
        </div><!-- row -->
    </div><!-- container -->


<!-- addCompany Modal -->
<div id="companyModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">新增</h4>
      </div>
      <div class="modal-body">
        <div class="row">
                    <label for="addEmployeeId">公司ID</label>
                    <input type="text" class="form-control" id="addCompanyId">
                </div>
                
                <div class="row">
                    <label for="addCompany">公司名稱</label>
                    <input type="text" class="form-control" id="addCompany">
                </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">新增</button>
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
                <h4 class="modal-title">修改</h4>
      </div>
      <div class="modal-body">
        <div class="row">
                    <label for="addEmployeeId">公司ID</label>
                    <input type="text" class="form-control" id="addCompanyId">
         </div>
                
                <div class="row">
                    <label for="addCompany">公司名稱</label>
                    <input type="text" class="form-control" id="addCompany">
                </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">修改</button>
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
                <h4 class="modal-title">新增</h4>
      </div>
      <div class="modal-body">        
                <div class="row">
                    <label for="addCompany">公司</label>
                    <select class="form-control" id="addCompany">
                        <option value=""></option>
                    </select>
                </div>
                <div class="row">
                    <label for="addCompany">部門</label>
                    <input type="text" class="form-control" id="addCompany">
                </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">新增</button>
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
                <h4 class="modal-title">修改</h4>
      </div>
      <div class="modal-body">
        <div class="row">
                    <label for="addCompany">公司</label>
                    <select class="form-control" id="addCompany">
                        <option value=""></option>
                    </select>
                </div>
                <div class="row">
                    <label for="addCompany">部門</label>
                    <input type="text" class="form-control" id="addCompany">
         </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">修改</button>
      </div>
    </div>
    <!-- end content -->
  </div>
</div>
<!-- end modal -->


@stop

