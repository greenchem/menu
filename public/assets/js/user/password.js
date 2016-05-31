$(function() {
  $('#passwordBtn').click(function() {
    var id = $('#user_id').val();
    var data = {};
    data._token = $('meta[name="csrf-token"]').attr('content');
    data.password = $('#password').val();
    if(_.trim(data.password) == '' ) {
      toastr['warning']('密碼不能為空');
      return;
    }

    console.log(data);
    $.ajax({
      url: `/api/account_sys/user/password/${id}`,
      method: 'put',
      data: data,
      success: function(result) {
        toastr['success']('修改密碼成功');
      },
      fail: function() {
        toastr['warning']('修改失敗，應該是權限不足');
      }
    });
  });
});


