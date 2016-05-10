<div class="modal fade" tabindex="-1" role="dialog" id="editAccount">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">編輯帳號</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <label for="editAccount">帳號</label>
                    <input type="text" class="form-control" id="editAccount" disabled>
                </div>
                <div class="row">
                    <label for="editEmail">信箱</label>
                    <input type="text" class="form-control" id="editEmail">
                </div>
                <div class="row">
                    <label for="editEmployeeId">員工ID</label>
                    <input type="text" class="form-control" id="editEmployeeId">
                </div>
                <div class="row">
                    <label for="editName">姓名</label>
                    <input type="text" class="form-control" id="editName">
                </div>
                <div class="row">
                    <label for="editCompany">公司名稱</label>
                    <select class="form-control" id="editCompany">
                        <option value=""></option>
                    </select>
                </div>
                <div class="row">
                    <label for="editGroup">單位</label>
                    <select class="form-control" id="editGroup">
                        <option value=""></option>
                    </select>
                </div>
                <div class="row">
                    <label for="editBeginDate">報到日期</label>
                    <input type="date" class="form-control" id="editBeginDate">
                </div>
                <div class="row">
                    <label for="editEndDate">離職日期</label>
                    <input type="date" class="form-control" id="editEndDate">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">更新</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


