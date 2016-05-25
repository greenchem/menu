var userData;
var groupData;
var quodaData;
var PeriodID;
var CompanyID;
var GroupID;
var month;
var year;

var CreateData = [];
var UpdateData = [];


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
            var i;
            quodaData = [];
            for(i=0; i<result.length; i++) {
                var periodID = result[i]['period_id'];
                var userID = result[i]['user_id'];
                if(!quodaData[periodID]) quodaData[periodID] = [];
                //quodaData[periodID].push(result[i]);
                quodaData[periodID][userID] = result[i];
            }
        }
    });

    var groupSelect = $('#groupSelect');
    var companySelect = $('#companySelect');
    var periodSelect = $('#period');

    periodSelect.val('');
    groupSelect.val('');
    companySelect.val('');




    //event
    clickEvent();

    periodSelect.change(function(){
        PeriodID = $(this).val();
        groupSelect.change();
    });

    companySelect.change(function(){
        CompanyID = $(this).val();
        groupSelect.find('option').each(function(){
            if($(this).data('company_id') == CompanyID) $(this).removeClass('hide');
            else $(this).addClass('hide');
        });
        $('#accountContent').empty();
        groupSelect.val('');
    });

    groupSelect.change(function(){
        GroupID = $(this).val();
        var i;
        var str = '';
        for(i=0; i<userData.length; i++) {
            if(userData[i]['company_id'] == CompanyID && userData[i]['group_id'] == GroupID) {
                str += '<tr data-userid = ' + userData[i]['id'] +'>' +
                    '<th class="username">' + userData[i]['username'] + '</th>' +
                    '<th class="nickname">' + userData[i]['nickname'] + '</th>' +
                    '<th class="companyName">' + userData[i]['company']['name'] + '</th>' +
                    '<th class="groupName">' + userData[i]['group']['name'] + '</th>' +
                    '<th class="position">' + userData[i]['position'] + '</th>';
                    if(!quodaData[PeriodID][userData[i]['id']]) { // create
                        str += '<th><input type="text" value="0" class="setQuodaInput form-control"/><button type="button" class="add btn btn-primary">新增</button></th></tr>'
                    } else { // update
                        str += '<th><input type="text" value="' + quodaData[PeriodID][userData[i]['id']]['quota'] + '" class="setQuodaInput form-control"/><button type="button" class="add btn btn-warning">修改</button></th></tr>';
                    }
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
        var i, isCreate = false, isUpdate = false;

        if(!quodaData[PeriodID][userID]) { // create
            for(i=0; i<CreateData.length; i++) {
                if(CreateData[i]['periodID'] == PeriodID && CreateData[i]['userID'] == userID) {
                    CreateData[i]['quota'] = quoda;
                    isCreate = true;
                }
            }

            if(!isCreate)
                CreateData.push({'periodID' : PeriodID , 'userID' : userID, 'quota' : quoda});
            isCreate = true;
        } else { //update
            var qID = quodaData[PeriodID][userID]['id'];
            for(i=0; i<UpdateData.length; i++) {
                if(UpdateData[i]['id'] == qID) {
                    UpdateData[i]['quota'] = quoda;
                    isUpdate = true;
                }
            }

            if(!isUpdate)
                UpdateData.push({'id' : qID , 'quota' : quoda});
            isUpdate = true;
        }

        console.log('create:', CreateData);
        console.log('update:', UpdateData);

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

    $('#checkCreateBtn').on('click', function(){
        $(this).addClass('disabled');
        var i;
        for(i=0; i<CreateData.length; i++) {
            $.ajax({
                url: '/api/menu_sys/user_quota/',
                type: 'POST',
                data: {
                    user_id: CreateData[i]['userID'],
                    period_id: CreateData[i]['periodID'],
                    quota: CreateData[i]['quota'],
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                error: function(error) {
                    toastr['error']('伺服器錯誤!');
                },
                success: function(result) {
                    console.log('post Create:', result);
                    if(result['status'] == 0) {
                        //location.reload();
                    } else {
                        toastr['error']('新增失敗!');
                        $(this).removeClass('disabled');
                    }
                }
            });
        }

        for(i=0; i<UpdateData.length; i++) {
            $.ajax({
                url: '/api/menu_sys/user_quota/' + UpdateData[i]['id'],
                _method: 'put',
                type: 'put',
                data: {
                    quota: UpdateData[i]['quota'],
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                error: function(error) {
                    toastr['error']('伺服器錯誤!');
                },
                success: function(result) {
                    console.log('put Update:', result);
                    if(result['status'] == 0) {
                        //location.reload();
                    } else {
                        toastr['error']('編輯失敗!');
                        $(this).removeClass('disabled');
                    }
                }
            });
        }
    });
}
