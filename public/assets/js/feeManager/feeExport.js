$(function() {
  changeEvent();
  clickEvent();
  $('#type').change();
});

var creationLog = JSON.parse($('#creationLog').val());
var flag;// use to judge creation log zero or more than one

function changeEvent() {
  $('#type').unbind('change');
  $('#type').change(function() {
    var i;
    var type = $(this).val();
    var text = '';

    var e;
    var id;
    var timestamp;

    flag = 0;// zero creation log
    for(i=0; i<creationLog.length; i++) {
      e = creationLog[i];
      if(e.type != type) { continue; }

      flag = 1;// at least one
      id = e.id;
      timestamp = e.timestamp
      text += `<option value="${id}">${timestamp}</option>`;
    }

    $('#timestamp').html(text);

    if(flag == 0) {
      toastr['warning']('這個類型並沒有報表可以匯出');
    }
  });
}

function clickEvent() {
  $('#exportBtn').unbind('click');
  $('#exportBtn').click(function() {
    if(flag == 0) {
      toastr['warning']('這個類型並沒有報表可以匯出');
      return;
    }


    var id = $('#timestamp').val();
    var timestamp = $(`#timestamp option[value="${id}"]`).html();
    var _token = $('meta[name="csrf-token"]').attr('content');

    window.location = `/api/accounting_sys/creation_log/export?_token=${_token}&timestamp=${timestamp}`;
  });
}


