<div class="modal fade" tabindex="-1" role="dialog" id="editElement">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">修改商品</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <label for="editName">名稱</label>
                    <input type="text" class="form-control" id="editName">
                </div>
                <div class="row">
                    <label for="editUnit">單位</label>
                    <input type="text" class="form-control" id="editUnit">
                </div>
                <div class="row">
                    <label for="editInventory">庫存</label>
                    <select class="form-control" id="editInventory">
                        @for($i=0; $i<200; $i++)
                        <option value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select>
                </div>
                <div class="row">
                    <label for="editPrice">價錢</label>
                    <input type="text" class="form-control" id="editPrice">
                </div>
                <div class="row">
                    <label for="editDescription">描述</label>
                    <input type="text" class="form-control" id="editDescription">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="editElementBtn">確認修改</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


