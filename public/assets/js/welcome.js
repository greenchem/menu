$(function() {
    $('#loginBtn').click(function(){
        var username = $('#username').val();
        var password = $('#password').val();
        if(!username || !password) {
            toastr['error']('請確實填寫所有欄位!');
            return;
        }

        $.ajax({
            url: '/api/account_sys/auth/login',
            type: "GET",
            data: {
                username: username,
                password: password
            },
            error: function (error) {
                toastr['error']('伺服器錯誤!');
            },
            success: function (result) {
                console.log(result);
                if(result['status'] == 0) {
                    location.reload();
                } else {
                    toastr['error']('登入失敗!');
                }
            }
        });

    });
});