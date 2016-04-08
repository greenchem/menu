<div class="modal fade" tabindex="-1" role="dialog" id="addMenu">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">新增菜單</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <label for="name">菜單名稱</label>
                    <input type="text" class="form-control" id="name">
                </div>
                <div class="row">
                    <label for="menu">繼承菜單</label>
                    <select id="menu" class="form-control">
                        <option disabled>菜單名稱</option>
                        <option value="">不繼承</option>
                        <option value="">春節</option>
                        <option value="">端午節</option>
                    </select>
                </div>
                <br>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">新增</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


