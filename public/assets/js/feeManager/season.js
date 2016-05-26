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
  $('#addYear, #addSeason').unbind('change');
  $('#addYear, #addSeason').change(function() {
    addData = {};
    $('#addTempTable tbody').html(null);
    $('#addCompany').change();
  });

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
    produceAddTempTable();
  });

  $('#editGroup').unbind('change');
  $('#editGroup').change(function() {
    produceEditTempTable();
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

      editData = {};
      $.each(result, function(idx, val) {
        var id = val.user_id;
        editData[id] = val;
      });

      appendToEditTable();
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

  $('#addTempBtn').unbind('click');
  $('#addTempBtn').click(function() {
    if(checkSeasonTimestamp() == 'exist') { return; }

    $('.addTempFee').each(function() {
      var id = $(this).data('id');

      addData[id] = {};
      addData[id]['fee'] = $(this).val();
    });

    appendToAddTable();
  });

  $('#editTempBtn').unbind('click');
  $('#editTempBtn').click(function() {
    if(checkTimestampStatus() != 'unlocked') { return; }

    $('.editTempFee').each(function() {
      var id = $(this).data('id');

      editData[id] = {};
      editData[id]['fee'] = $(this).val();
    });

    appendToEditTable();
  });
}

function tableEvent() {
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

  $('.deleteEditTempFee').unbind('click');
  $('.deleteEditTempFee').click(function() {
    $(this).parent().parent().remove();
  });

  $('.deleteAddFee').unbind('click');
  $('.deleteAddFee').click(function() {
    var id = $(this).data('id');

    $(this).parent().parent().remove();
    delete editData[id];
  });
}

function dataEvent() {
  $('#addBtn').unbind('click');
  $('#addBtn').click(function() {
    if(checkSeasonTimestamp() == 'exist') { return; }
    if(checkAddData() == 'zero') { return;  }

    var year = $('#addYear').val();
    var season = $('#addSeason').val()
    var timestamp = `${year} ${season}`;
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
    if(checkTimestampStatus() != 'unlocked') { return; }

    var data = {};
    data._token = $('meta[name="csrf-token"]').attr('content');
    data.creation_log_id = $('#currentEditCreationId').val();

    $.ajax({// Delete All
      url: `/api/accounting_sys/fee_log/list`,
      data: data,
      method: 'delete',
      success: function(result) {
        var id = $('#editTimestamp').val();
        data.timestamp = $(`#editTimestamp option[value="${id}"]`).html();

        data.type = $('#type').val();
        data.fee_logs = [];

        $.each(editData, function(idx, val) {
          var e = [];
          e[0] = idx;
          e[1] = val.fee;

          data.fee_logs.push(e);
        });

        console.log(data);
        data.fee_logs = JSON.stringify(data.fee_logs);
        $.post('/api/accounting_sys/creation_log', data, function(result) {
          if(result.status == 2) {
            toastr['warning']('更新失敗');
          }else if(result.status == 0) {
            toastr['success']('更新成功');
            $('#feeClassBG li.manageDiv').click();
          }
        }).fail(function() {

        });
      },
      fail: function() {

      }
    });
  });
}


