$(function() {
    $('#exportBtn').on('click', function(){
        var period = $('#period').val();
        var type = $('#type').val();

        if(!period || !type) {
            toastr['error']('請確實填寫所有欄位!');
            return;
        }

        window.location = "/api/menu_sys/exports/" + type + "/?period_id=" + period;
    });
});



