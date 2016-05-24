var userData;
var groupData;
var quodaData;
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
        url: '/api/menu_sys/user_quota',
        type: "GET",
        error: function() {
            toastr['error']('伺服器錯誤!');
        },
        success: function(result) {
            quodaData = result;
            console.log(quodaData);
        }
    });

    var groupSelect = $('#groupSelect');
    var companySelect = $('#companySelect');

    groupSelect.val('');
    companySelect.val('');




    //event

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
                    '<th class="username">' + userData[i]['username'] + '</th>' +
                    '<th class="nickname">' + userData[i]['nickname'] + '</th>' +
                    '<th class="companyName">' + userData[i]['company']['name'] + '</th>' +
                    '<th class="groupName">' + userData[i]['group']['name'] + '</th>' +
                    '<th class="position">' + userData[i]['position'] + '</th>' +
                    '<th><input type="text" class="setQuodaInput form-control"/><button type="button" class="add btn btn-primary">新增</button></th>' +
                    '</tr>';
            }
        }
        $('#accountContent').empty().append(str);
        clickEvent();
    });

});

function clickEvent()
{
    $('#accountContent .add').on('click', function(){
        var parent = $(this).parent().parent();
        var userID = parent.data('userid');
        var userName = parent.find('.username').html();
        var nickname = parent.find('.nickname').html();
        var companyName = parent.find('.companyName').html();
        var groupName = parent.find('.groupName').html();
        var position = parent.find('.position').html();
        var quoda = parent.find('.setQuodaInput').val();

        var content = $('#readyToCreate .quodaContent');
        var swit = false;
        content.find('tr').each(function(){
            if($(this).data('userid') == userID) {
                $(this).find('.quoda').html(quoda);
                swit = true;
                return false;
            }
        });
        if(swit) return;

        var str = '<tr data-userid="' + userID + '"><th>' + userName + '</th><th>' + nickname + '</th><th>' + companyName + '</th><th>' + groupName + '</th><th>' + position +'</th><th class="quoda">' + quoda + '</th></tr>';
        content.append(str);
    });
}