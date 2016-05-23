$(function() {
  clickEvent();
  changeEvent();

  init();
});

var groupData = JSON.parse($('#groupData').val());
var creationData;
var feelogData;
var peopleData;

function init() {
  var data = {};
  data._token = $('meta[name="csrf-token"]').attr('content');

  $('#menuTable tbody').html('');
  $.get('/api/account_sys/user/', data, function(people) {// get People
    console.log(people);
    peopleData = people;

    $('#feeClassBG li:first').click();
  }).fail(function() {
    toastr['error']('請先登入');
  });
}

function changeEvent() {
  $('#addCompany').unbind('change');
  $('#addCompany').change(function() {
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
    produceAddTable();
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

    produceEditTable(log);
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
      creationData = result;

      outsideThis.parent().find('.active').removeClass('active');
      var targetClass = outsideThis.attr('class');

      if(targetClass == 'addRecordDiv') {
        $('#addCompany').change();
      }else if(targetClass == 'manageDiv') {
        produceTimestamp();

        $('#editTimestamp').change();
      }

      outsideThis.addClass('active');
      $('#feeContentDiv .feeContent').css('display', 'none');
      $('#feeContentDiv .feeContent.' + targetClass).css('display', 'block');
    }).fail(function() {

    });
  });

  $('#addBtn').unbind('click');
  $('#addBtn').click(function() {
    var year = $('#addYear').val();
    var month = $('#addMonth').val();
    var timestamp = (month<10) ? `${year}-0${month}` : `${year}-${month}`;
    var type = $('#type').val();
    var i;
    var j;
    var e;
    var e1;
    var originLength;
    var creationLogId;
    var exist = 'nothing';// nothing means nothing, exist means exist
    var data;

    for(i=0; i<creationData.length; i++) {
      e = creationData[i];
      if(e.timestamp == timestamp && e.type == type) {
        exist = 'exist';
        creationLogId = e.id;
        break;
      }
    }

    if(exist == 'exist') {// CreationLog Exist
      console.log('exist');
      data = {};
      data._token = $('meta[name="csrf-token"]').attr('content');
      data.creation_log_id = creationLogId;

      // get feelogs that belong this creation log
      $.get('/api/accounting_sys/fee_log', data, function(feelogData) {
        console.log(feelogData);
        data.fee_logs = [];
        $('.addFee').each(function() {
          var e = [];
          e[0] = $(this).data('id');
          e[1] = $(this).val();

          data.fee_logs.push(e);
        });
        originLength = data.fee_logs.length;

        // check user_id and creation_log_id unique?
        for(i=0; i<feelogData.length; i++) {
          e = feelogData[i];
          for(j=0; j<data.fee_logs.length; j++) {
            e1 = data.fee_logs[j];
            if(e.user_id == e1[0]) {
              data.fee_logs.splice(j, 1);// remove this
              break;
            }
          }
        }

        if(data.fee_logs.length > 0) {// some not yet insert
          if(data.fee_logs.length != originLength) {
            toastr['warning']('仍有部份帳號未新增過津貼紀錄，系統仍幫您新增，但不包含已新增過的帳號，已新增過津貼紀錄的帳號，只能修改而不是新增');
          }
          data.fee_logs = JSON.stringify(data.fee_logs);
          data.type = type;
          data.timestamp = timestamp;

          $.post('/api/accounting_sys/creation_log', data, function(result) {
            console.log(result);
            if(result.status == 0) {
              toastr['success']('新增成功');
            }else {
              toastr['warning']('您權限不足，無法新增');
            }
          }).fail(function() {

          });
        }else {// conflict
          toastr['warning']('此次填寫的所有帳號都已新增過此類津貼，無法再次新增');
        }
      });
    }else {// new CreationLog and FeeLog
      data = {};
      data._token = $('meta[name="csrf-token"]').attr('content');
      data.type = type;
      data.timestamp = timestamp;
      data.fee_logs = [];
      $('.addFee').each(function() {
        var e = [];
        e[0] = $(this).data('id');
        e[1] = $(this).val();

        data.fee_logs.push(e);
      });

      data.fee_logs = JSON.stringify(data.fee_logs);
      console.log(data);
      $.post('/api/accounting_sys/creation_log', data, function(result) {// create new creation log and fee log
        console.log(result);
        if(result.status == 0) {
          toastr['success']('新增成功');
          $.get('/api/accounting_sys/creation_log', data, function(result) {// get new creation data
            creationData = result;
          });
        }else {
          toastr['warning']('您權限不足，無法新增');
        }
      }).fail(function() {

      });
    }
  });

  $('#editBtn').unbind('click');
  $('#editBtn').click(function() {
    var status = $('#currentEditCreationStatus').val();

    if(status != 'unlocked') {
      toastr['warning']('此筆紀錄已被鎖住，無法被編輯');
      return;
    }

    var i;
    var e;
    var e1;
    var edit = [];
    $('.editFee').each(function() {
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

