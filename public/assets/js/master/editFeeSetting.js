var creationData;
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

    $.ajax({
        url: '/api/accounting_sys/creation_log',
        type: "GET",
        error: function() {
            toastr['error']('伺服器錯誤!');
        },
        success: function(result) {
            creationData = result;
        }
    });



    var feeTypeSelect = $('#feeType');
    var yearSelect = $('#yearSelect');
    var monthSelect = $('#monthSelect');
    var groupSelect = $('#groupSelect');
    var companySelect = $('#companySelect');

    for(var i = 2016; i <= yyyy; i++) {
        yearSelect.append("<option value=" + i + ">" + i + "</option>");
    }
    yearSelect.val('');
    monthSelect.val('');
    feeTypeSelect.val('');
    groupSelect.val('');
    companySelect.val('');




    //event

    clickEvent();

    feeTypeSelect.change(function(){
        monthSelect.val('');
        feeType = $(this).val();
        if(feeType == 'parking') {
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

    //useless
    companySelect.change(function(){
        companyID = $(this).val();
        groupSelect.find('option').each(function(){
            if($(this).data('company_id') == companyID) $(this).removeClass('hide');
            else $(this).addClass('hide');
        });
        $('#accountContent').empty();
        groupSelect.val('');
    });

    //useless
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
    $('.createFeePermissionBtn').on('click', function(){
        if(!feeType || !year || !month) {
            toastr['error']('請確實填寫所有欄位!');
            return;
        }
        var i;
        var timestamp = year + '-' + month;
        if(feeType == 'parking')
            timestamp = year + ' ' + month;

        var creationID;
        for(i=0; i<creationData.length; i++) {
            if(timestamp == creationData[i]['timestamp'] && feeType == creationData[i]['type']) {
                creationID = creationData[i]['id'];
                break;
            }
        }

        if(creationID) {
            $.ajax({
                url: '/api/accounting_sys/creation_log/unlock/' + creationID,
                _method: 'put',
                type: 'put',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                error: function(error) {
                    toastr['error']('伺服器錯誤!');
                },
                success: function(result) {
                    console.log(result);
                    if(result['status'] == 0) {
                        toastr['success']('新增成功!');
                        setTimeout(function(){
                            location.reload();
                        }, 3000);
                    } else {
                        toastr['error']('新增失敗!');
                    }
                }
            });
        } else {
            toastr['error']('查無紀錄!');
        }
    });
}