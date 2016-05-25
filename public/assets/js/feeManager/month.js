$(function() {
  clickEvent();
  changeEvent();
  dataEvent();

  init();
});

var groupData = JSON.parse($('#groupData').val());
var creationData;
var feelogData;
var peopleData;
var peopleDataById;
var addData;
var editData;

function init() {
  var data = {};
  data._token = $('meta[name="csrf-token"]').attr('content');

  $('#menuTable tbody').html('');
  $.get('/api/account_sys/user/', data, function(people) {// get People
    console.log(people);
    peopleData = people;
    peopleDataById = {};
    $.each(peopleData, function(idx, val) {
      var id = val.id;
      peopleDataById[id] = val;
    });

    $('#feeClassBG li:first').click();
  }).fail(function() {
    toastr['error']('請先登入');
  });
}

function changeEvent() {
  $('#addYear, #addMonth').unbind('change');
  $('#addYear, #addMonth').change(function() {
    if(checkMonthTimestamp() == 'exist') { return; }

    addData = {};
    $('#addTempTable tbody').html(null);
    $('#addCompany').change();
  });

  $('#addCompany').unbind('change');
  $('#addCompany').change(function() {
    if(checkMonthTimestamp() == 'exist') { return; }

    var company = $('#addCompany').val();

    produceGroup($('#addGroup'), company);
    $('#addGroup').change();
  });

  $('#editCompany').unbind('change');
  $('#editCompany').change(function() {
    var company = $('#editCompany').val();

    produceGroup($('#editGroup'), company);
    $('#editGroup').change();
  });

  $('#addGroup').unbind('change');
  $('#addGroup').change(function() {
    if(checkMonthTimestamp() == 'exist') { return; }

    produceAddTempTable();
  });

  $('#editGroup').unbind('change');
  $('#editGroup').change(function() {
    var group = $(this).val();
    var i;
    var e;
    var log = [];

    for(i=0; i<feelogData.length; i++) {
      e = feelogData[i];
      if(e.user.group_id == group) {
        log.push(e);
      }
    }

    produceEditTempTable(log);
  });

  $('#editTimestamp').unbind('change');
  $('#editTimestamp').change(function() {
    var id = $(this).val();
    var status = $(`#editTimestamp option[value="${id}"]`).data('status');

    // set env
    $('#currentEditCreationStatus').val(status);
    $('#currentEditCreationId').val(id);

    var data = {};
    data._token = $('meta[name="csrf-token"]').attr('content');
    data.creation_log_id = id;

    $.get('/api/accounting_sys/fee_log', data, function(result) {
      console.log(result);
      feelogData = result;

      $('#editCompany').change();
    });
  });
}

function clickEvent() {
  $('#feeClassBG li').unbind('click');
  $('#feeClassBG li').click(function() {
    var outsideThis = $(this);
    var data = {};
    data._token = $('meta[name="csrf-token"]').attr('content');

    $.get('/api/accounting_sys/creation_log', data, function(result) {// get CreationLog
      var i;
      var type = $('#type').val();
      creationData = [];
      for(i=0; i<result.length; i++) {// creation log filter
        e = result[i];
        if(e.type != type) {
          continue;
        }

        creationData.push(e);
      }

      outsideThis.parent().find('.active').removeClass('active');
      var targetClass = outsideThis.attr('class');

      if(targetClass == 'addRecordDiv') {// choose add
        resetAdd();
        $('#addYear').change();
      }else if(targetClass == 'manageDiv') {// choose edit
        if(creationData.length == 0) {
          toastr['warning']('目前沒有任何紀錄');
        }
        produceTimestamp();

        $('#editTimestamp').change();
      }

      outsideThis.addClass('active');
      $('#feeContentDiv .feeContent').css('display', 'none');
      $('#feeContentDiv .feeContent.' + targetClass).css('display', 'block');
    }).fail(function() {

    });
  });

  $('.deleteAddTempFee').unbind('click');
  $('.deleteAddTempFee').click(function() {
    $(this).parent().parent().remove();
  });

  $('.deleteAddFee').unbind('click');
  $('.deleteAddFee').click(function() {
    var id = $(this).data('id');

    $(this).parent().parent().remove();
    delete addData[id];
  });

  $('#addTempBtn').unbind('click');
  $('#addTempBtn').click(function() {
    $('.addTempFee').each(function() {
      var id = $(this).data('id');

      addData[id] = {};
      addData[id]['fee'] = $(this).val();
    });

    appendToAddTable();
  });
}

function dataEvent() {
  $('#addBtn').unbind('click');
  $('#addBtn').click(function() {
    if(checkMonthTimestamp() == 'exist') { return; }
    if(checkAddData() == 'zero') { return;  }

    var year = $('#addYear').val();
    var month = $('#addMonth').val();
    var timestamp = (month<10) ? `${year}-0${month}` : `${year}-${month}`;
    var data = {};

    data._token = $('meta[name="csrf-token"]').attr('content');
    data.type = $('#type').val();
    data.timestamp = timestamp;
    data.fee_logs = [];
    $.each(addData, function(idx, val) {
      var e = [];
      e[0] = idx;
      e[1] = val.fee;

      data.fee_logs.push(e);
    });

    data.fee_logs = JSON.stringify(data.fee_logs);
    console.log(data);
    $.post('/api/accounting_sys/creation_log', data, function(result) {// create new creation log and fee log
      console.log(result);
      if(result.status == 0) {
        toastr['success']('新增成功');
        $('#feeClassBG li:first').click();
      }else {
        toastr['warning']('您權限不足，無法新增');
      }
    }).fail(function() {

    });
  });

  $('#editBtn').unbind('click');
  $('#editBtn').click(function() {
    var status = $('#currentEditCreationStatus').val();

    if(status != 'unlocked') {
      toastr['warning']('此筆紀錄已被鎖住，無法被編輯');
      return;
    }

    var edit = [];
    $('.editFee').each(function() {
      var e;
      var current = $(this).data('id');// current user id
      var fee = $(this).val();

      for(i=0; i<feelogData.length; i++) {
        e = feelogData[i];
        if(e.user_id == current) {// remove user log from history
          feelogData.splice(i, 1);
          break;
        }
      }

      e = [];
      e[0] = current;
      e[1] = fee;
      edit.push(e);
    });

    var data = {};
    data._token = $('meta[name="csrf-token"]').attr('content');
    data.creation_log_id = $('#currentEditCreationId').val();

    $.ajax({// Delete All
      url: `/api/accounting_sys/fee_log/list`,
      data: data,
      method: 'delete',
      success: function(result) {
        data.type = $('#type').val();
        var id = $('#editTimestamp').val();
        data.timestamp = $(`#editTimestamp option[value="${id}"]`).html();
        data.fee_logs = [];

        for(i=0; i<feelogData.length; i++) {// insert not change data
          e = feelogData[i];
          e1 = [];
          e1[0] = e.user_id;
          e1[1] = e.fee;

          data.fee_logs.push(e1);
        }

        for(i=0; i<edit.length; i++) {
          e = edit[i];
          data.fee_logs.push(e);
        }

        console.log(data);
        data.fee_logs = JSON.stringify(data.fee_logs);
        $.post('/api/accounting_sys/creation_log', data, function(result) {
          if(result.status == 2) {
            toastr['warning']('更新失敗');
          }else if(result.status == 0) {
            toastr['success']('更新成功');
            $('#editTimestamp').change();
          }
        }).fail(function() {

        });
      },
      fail: function() {

      }
    });
  });
}


