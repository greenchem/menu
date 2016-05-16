var TOAST = $('#toast-container .toast');

$(function() {
  clickEvent();
  $('#feeClassBG li:first').click();
  clickEvent();
});

function clickEvent() {
  $('#feeClassBG li').on('click', function(){
    $(this).parent().find('.active').removeClass('active');
    var targetClass = $(this).attr('class');
    $(this).addClass('active');
    $('#feeContentDiv .feeContent').css('display', 'none');
    $('#feeContentDiv .feeContent.' + targetClass).css('display', 'block');
  });

  companyEvent();
  groupEvent();
}

function companyEvent()
{
  //create company
  $('#addCompanyContainer #companyModal #addCompanyButton').unbind('click');
  $('#addCompanyContainer #companyModal #addCompanyButton').on('click', function(){
    $.ajax({
      url: '/api/account_sys/company/',
      type: "POST",
      data: {
        name: $('#addCompany-companyName').val(),
        _token: $("meta[name='csrf-token']").attr("content")
      },
      error: function (error) {
        toastr['error']('伺服器錯誤!');
      },
      success: function (result) {
        console.log(result);
        if(result['status'] == 0) {
          location.reload();
        } else {
          Materialize.toast('<span>新增公司失敗!</span>', 5000, 'rounded');
          TOAST.addClass('toast-errorr');
        }
      }
    });
  });

  //edit company
  $('#addCompanyContainer #feeContentDiv .editCompany').unbind('click');
  $('#addCompanyContainer #feeContentDiv .editCompany').on('click', function(){
    var companyName = $(this).parent().data('companyname');
    var companyId = $(this).parent().data('companyid');
    $('#editCompanyModal').data('companyid', companyId);
    $('#editCompanyModal #editCompany-companyName').val(companyName);
  });


  //check edit company
  $('#editCompanyModal #checkEditCompanyButton').unbind('click');
  $('#editCompanyModal #checkEditCompanyButton').on('click', function(){
    $.ajax({
      url: '/api/account_sys/company/' + $('#editCompanyModal').data('companyid'),
      _method: 'put',
      type: 'put',
      data: {
        name: $('#editCompanyModal #editCompany-companyName').val(),
        _token: $('meta[name="csrf-token"]').attr('content')
      },
      error: function(error) {
        toastr['error']('伺服器錯誤!');
      },
      success: function(result) {
        console.log(result);
        if(result['status'] == 0) {
          location.reload();
        } else {
          Materialize.toast('<span>編輯公司失敗!</span>', 5000, 'rounded');
          TOAST.addClass('toast-errorr');
        }
      }
    });
  });

  //delete company
  $('#addCompanyContainer #feeContentDiv .deleteCompany').unbind('click');
  $('#addCompanyContainer #feeContentDiv .deleteCompany').on('click', function() {
    var companyName = $(this).parent().data('companyname');
    var companyId = $(this).parent().data('companyid');
    $('#deleteCompanyModal').data('companyid', companyId);
    $('#deleteCompanyModal .companyName').html(companyName);
  });

  //check delete company
  $('#deleteCompanyModal #checkDeleteCompanyButton').unbind('click');
  $('#deleteCompanyModal #checkDeleteCompanyButton').on('click', function() {
    $.ajax({
      url: '/api/account_sys/company/' + $('#deleteCompanyModal').data('companyid'),
      _method: 'delete',
      status: 'deleted',
      type: 'delete',
      data: {
        _token: $('meta[name="csrf-token"]').attr('content')
      },
      error: function (error) {
        toastr['error']('伺服器錯誤!');
      },
      success: function (result) {
        if(result['status'] == 0) {
          location.reload();
        } else {
          Materialize.toast('<span>刪除公司失敗!</span>', 5000, 'rounded');
          TOAST.addClass('toast-errorr');
        }
      }
    });
  });
}

function groupEvent()
{
  // create group
  $('#groupModal #addGroupButton').unbind('click');
  $('#groupModal #addGroupButton').on('click', function(){
    var companyId = $('#groupModal #addGroup-companyName').val();
    var groupName = $('#groupModal #addGroup-groupName').val();
    $.ajax({
      url: '/api/account_sys/group/',
      type: "POST",
      data: {
        name: groupName,
        company_id: companyId,
        _token: $("meta[name='csrf-token']").attr("content")
      },
      error: function (error) {
        toastr['error']('伺服器錯誤!');
      },
      success: function (result) {
        console.log(result);
        if(result['status'] == 0) {
          location.reload();
        } else {
          Materialize.toast('<span>新增部門失敗!</span>', 5000, 'rounded');
          TOAST.addClass('toast-errorr');
        }
      }
    });
  });


  // update group
  $('#addCompanyContainer #feeContentDiv .editGroup').unbind('click');
  $('#addCompanyContainer #feeContentDiv .editGroup').on('click', function(){
    var groupId = $(this).parent().data('groupid');
    var companyId = $(this).parent().data('companyid');
    var groupName = $(this).parent().data('groupname');
    $('#editGroupModal #editGroup-companyName option').each(function(){
      if($(this).val() == companyId) {
        $(this).attr('selected', true);
      } else {
        $(this).attr('selected', false);
      }
    });
    $('#editGroupModal #editGroup-groupName').val(groupName);
    $('#editGroupModal').data('groupid', groupId);
  });

  // check update group
  $('#editGroupModal #checkEditGroupButton').unbind('click');
  $('#editGroupModal #checkEditGroupButton').on('click', function(){
    var companyId = $('#editGroupModal #editGroup-companyName').val();
    var groupId = $('#editGroupModal').data('groupid');
    var groupName = $('#editGroupModal #editGroup-groupName').val();
    $.ajax({
      url: '/api/account_sys/group/' + groupId + '/' + companyId,
      _method: 'put',
      type: 'put',
      data: {
        name: groupName,
        company_id: companyId,
        _token: $('meta[name="csrf-token"]').attr('content')
      },
      error: function(error) {
        toastr['error']('伺服器錯誤!');
      },
      success: function(result) {
        console.log(result);
        if(result['status'] == 0) {
          location.reload();
        } else {
          Materialize.toast('<span>編輯部門失敗!</span>', 5000, 'rounded');
          TOAST.addClass('toast-errorr');
        }
      }
    });
  });


  //delete group
  $('#addCompanyContainer #feeContentDiv .deleteGroup').unbind('click');
  $('#addCompanyContainer #feeContentDiv .deleteGroup').on('click', function(){
    var groupId = $(this).parent().data('groupid');
    var groupName = $(this).parent().data('groupname');
    var companyName = $(this).parent().data('companyname');
    $('#deleteGroupModal .companyName').html(companyName);
    $('#deleteGroupModal .groupName').html(groupName);
    $('#deleteGroupModal').data('groupid', groupId);
  });

  //check group
  $('#deleteGroupModal #checkDeleteGroupButton').unbind('click');
  $('#deleteGroupModal #checkDeleteGroupButton').on('click', function(){
    $.ajax({
      url: '/api/account_sys/group/' + $('#deleteGroupModal').data('groupid'),
      _method: 'delete',
      status: 'deleted',
      type: 'delete',
      data: {
        _token: $('meta[name="csrf-token"]').attr('content')
      },
      error: function (error) {
        toastr['error']('伺服器錯誤!');
      },
      success: function (result) {
        if(result['status'] == 0) {
          location.reload();
        } else {
          Materialize.toast('<span>刪除部門失敗!</span>', 5000, 'rounded');
          TOAST.addClass('toast-errorr');
        }
      }
    });
  });
}