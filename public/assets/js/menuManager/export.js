$(function() {
    $('#exportBtn').on('click', function(){
        var period = $('#period').val();
        var type = $('#type').val();

        if(!period || !type) {
            toastr['error']('請確實填寫所有欄位!');
            return;
        }


        $.ajax({
            url: '/api/menu_sys/exports/' +  type,
            type: "GET",
            data: {
                period_id: period
            },
            error: function (error) {
                toastr['error']('伺服器錯誤!');
            },
            success: function (result) {
                console.log(result);
            }
        });
    });
});



