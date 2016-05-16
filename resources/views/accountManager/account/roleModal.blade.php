<div class="modal fade" tabindex="-1" role="dialog" id="editRole">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">編輯帳號權限</h4>
            </div>
            <div class="modal-body">
              <div class="row">
                <label>帳號權限</label>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="role" value="5">一般使用者
                  </label>
                  <label>
                    <input type="checkbox" name="role" value="4">菜單管理者
                  </label>
                  <label>
                    <input type="checkbox" name="role" value="3">總務人員
                  </label>
                  <label>
                    <input type="checkbox" name="role" value="2">帳號管理者
                  </label>
                  <label>
                    <input type="checkbox" name="role" value="1">系統管理員
                  </label>
                </div>
              </div>
              @include('accountManager.account.roleREADME')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="editRoleBtn">更新</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


