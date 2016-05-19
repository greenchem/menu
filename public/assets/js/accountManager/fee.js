var userData;
var groupData;
var companyID;
var groupID;
var feeType;
var month;
var year;

var today = new Date();
var dd = today.getDate();
var mm = today.getMonth()+1; //January is 0!
var yyyy = today.getFullYear();


$(function () {
    // init
    $.ajax({
        url: '/api/account_sys/group',
        type: "GET",
        error: function() {
            toastr['error']('伺服器錯誤!');
        },
        success: function(result) {
            groupData = result;
        }
    });

    $.ajax({
        url: '/api/account_sys/user',
        type: "GET",
        error: function() {
            toastr['error']('伺服器錯誤!');
        },
        success: function(result) {
            userData = result;
        }
    });

    var feeTypeSelect = $('#feeType');
    var yearSelect = $('#yearSelect');
    var monthSelect = $('#monthSelect');
    var groupSelect = $('#groupSelect');
    var companySelect = $('#companySelect');

    for(var i = 2000; i <= yyyy; i++) {
        yearSelect.append("<option value=" + i + ">" + i + "</option>");
    }
    yearSelect.val('');
    monthSelect.val('');
    feeTypeSelect.val('');
    groupSelect.val('');
    companySelect.val('');




    //event

    feeTypeSelect.change(function(){
        monthSelect.val('');
        feeType = $(this).val();
        if(feeType == 'parking_logs') {
            monthSelect.find('.month').addClass('hide');
            monthSelect.find('.quarter').removeClass('hide');
        } else {
            monthSelect.find('.month').removeClass('hide');
            monthSelect.find('.quarter').addClass('hide');
        }
    });

    yearSelect.change(function(){
        year = $(this).val();
    });

    monthSelect.change(function(){
        month = $(this).val();
    });

    companySelect.change(function(){
        companyID = $(this).val();
        groupSelect.find('option').each(function(){
            if($(this).data('company_id') == companyID) $(this).removeClass('hide');
            else $(this).addClass('hide');
        });
        $('#accountContent').empty();
        groupSelect.val('');
    });

    groupSelect.change(function(){
        groupID = $(this).val();
        var i;
        var str = '';
        for(i=0; i<userData.length; i++) {
            if(userData[i]['company_id'] == companyID && userData[i]['group_id'] == groupID) {
                str += '<tr data-userid = ' + userData[i]['id'] +'>' +
                    '<th>' + userData[i]['username'] + '</th>' +
                    '<th>' + userData[i]['nickname'] + '</th>' +
                    '<th>' + userData[i]['company']['name'] + '</th>' +
                    '<th>' + userData[i]['group']['name'] + '</th>' +
                    '<th>' + userData[i]['position'] + '</th>' +
                    '<th><button type="button" class="createFeePermissionBtn btn btn-primary">新增津貼編輯權限</button></th>' +
                    '</tr>';
            }
        }
        $('#accountContent').empty().append(str);
        clickEvent();
    });

});

function clickEvent()
{
    $('#accountContent .createFeePermissionBtn').on('click', function(){
        if(!feeType || !year || !month) {
            toastr['error']('請確實填寫所有欄位!');
            return;
        }
        console.log('type: ' + feeType);
        console.log('year: ' + year);
        console.log('month: ' + month);
        console.log('user id: ' + $(this).parent().parent().data('userid'));
    });
}