$(function() {
    $('#exportBtn').on('click', function(){
        var period = $('#period').val();

        console.log(period);

        if(!period) {
            toastr['error']('請確實填寫所有欄位!');
            return;
        }

        window.location = "/api/menu_sys/exports/all_accounting_form/?period_id=" + period;
    });
});



