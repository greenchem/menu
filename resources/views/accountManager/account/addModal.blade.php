<div class="modal fade" tabindex="-1" role="dialog" id="addAccount">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">新增帳號</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <label for="addUsername">帳號</label>
                    <input type="text" class="form-control" id="addUsername">
                </div>
                <div class="row">
                    <label for="addPassword">密碼</label>
                    <input type="text" class="form-control" id="addPassword">
                </div><!--
                <div class="row">
                    <label for="addEmail">信箱</label>
                    <input type="text" class="form-control" id="addEmail">
                </div>
                <div class="row">
                    <label for="addEmployeeId">員工ID</label>
                    <input type="text" class="form-control" id="addEmployeeId">
                  </div>-->
                <div class="row">
                    <label for="addNickname">姓名</label>
                    <input type="text" class="form-control" id="addNickname">
                </div>
                <div class="row">
                    <label for="addCompany">公司名稱</label>
                    <select class="form-control" id="addCompany">
                    @for($i=0; $i<count($companyData); $i++)
                    <option value="{{$companyData[$i]['id']}}">{{$companyData[$i]['name']}}</option>
                    @endfor
                    </select>
                </div>
                <div class="row">
                    <label for="addGroup">單位</label>
                    <select class="form-control" id="addGroup"></select>
                </div>
                <div class="row">
                  <label for="addPosition">職等</label>
                  <input class="form-control" type="text" id="addPosition">
                </div>

                  <!--
                <div class="row">
                    <label for="addBeginDate">報到日期</label>
                    <input type="date" class="form-control" id="addBeginDate">
                </div>
                <div class="row">
                    <label for="addEndDate">離職日期</label>
                    <input type="date" class="form-control" id="addEndDate">
                  </div>-->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="addBtn">新增</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


