$(function() {
  clickEvent();
  changeEvent();

  init();
});

var groupData = JSON.parse($('#groupData').val());
var creationData;
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
    var data = {};
    data._token = $('meta[name="csrf-token"]').attr('content');

    $.get(`/api/accounting_sys/fee_log`, data, function(log) {
      console.log(log);
    }).fail(function() {

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
        $('#editCompany').change();
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
      $.post('/api/accounting_sys/creation_log', data, function(result) {
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
}

function produceAddTable() {
  // env
  var company = $('#addCompany').val();
  var group = $('#addGroup').val();

  var text = '';
  var i;
  var e;
  var id;
  var username;
  var nickname;

  for(i=0; i<peopleData.length; i++) {
    e = peopleData[i];
    if(company != e.company_id || group != e.group_id) {
      continue;
    }

    id = e.id;
    username = e.username;
    nickname = e.nickname;

    text += `<tr>`;
    text += `<td>${username}</td>`;
    text += `<td>${nickname}</td>`;
    text += `<td>`;
    text += `<input type="text" class="form-control addFee" placeholder="金額" value="0"`;
    text += `data-id="${id}">`;
    text += `</td>`;
    text += `</tr>`;
  }

  $('#addTable tbody').html(text);
}

function produceEditTable(log) {
  var text = '';
  var i;
  var e;
  var id;
  var username;
  var nickname;

  for(i=0; log.length; i++) {
    e = log[i];

    text += `<tr>`;
    text += `<td>${username}</td>`;
    text += `<td>${nickname}</td>`;
    text += `<td>`;
    text += `<input type="text" class="form-control addFee" placeholder="金額"`;
    text += `data-employee_id="${employeeId}"`;
    text += `data-id="${id}">`;
    text += `</td>`;
    text += `<td><button class="btn btn-danger deleteBtn" data-id="${id}">刪除</button></td>`;
    text += `</tr>`;
  }

  $('#editTable tbody').html(text);
}

function produceGroup(target, company) {
  var i;
  var text = '';
  var e;
  var id;
  var name;
  var company_id;

  for(i=0; i<groupData.length; i++) {
    e = groupData[i];
    if(company != e.company_id) {
      continue;
    }

    id = e.id;
    name = e.name;
    text += `<option value="${id}">${name}</option>`;
  }

  target.html(text);
}

function getCreationLog() {
  var data = {};
  data._token = $('meta[name="csrf-token"]').attr('content');

  $.get('/api/accounting_sys/creation_log', data, function(creation) {
    console.log(creation);
  }).fail(function() {

  });
}

function getFeeLog(id) {
  var data = {};
  data._token = $('meta[name="csrf-token"]').attr('content');
  data.creation_log_id = id;

  $.get('/api/accounting_sys/fee_log', data, function(fee) {
    console.log(fee);
  }).fail(function() {

  });
}

