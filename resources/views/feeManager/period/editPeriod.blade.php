<div class="modal fade" tabindex="-1" role="dialog" id="editPeriodModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">新增期號</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <label for="editName">期號名稱</label>
                    <input type="text" class="form-control" id="editName">
                </div>
            </div>
            <div class="modal-body">
                <div class="row">
                    <label for="editStatus">期號上線</label>
                    <select class="form-control" id="editStatus">
                        <option value="invisible">關閉</option>
                        <option value="visible">開啟</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="editPeriodBtn">修改</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


