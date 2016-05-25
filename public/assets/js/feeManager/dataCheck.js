function checkMonthTimestamp() {
  var year = $('#addYear').val();
  var month = $('#addMonth').val();
  var timestamp = (month<10) ? `${year}-0${month}` : `${year}-${month}`;
  var e;

  for(i=0; i<creationData.length; i++) {
    e = creationData[i];

    if(e.timestamp == timestamp) {
      toastr['warning'](`${timestamp} 已經新增過了，只能修改無法新增`);
      return 'exist';
    }
  }

  return 'not exist';
}

function checkSeasonTimestamp() {
  var year = $('#addYear').val();
  var season = $('#addSeason').val();
  var timestamp = `${year} ${season}`;
  var e;

  for(i=0; i<creationData.length; i++) {
    e = creationData[i];

    if(e.timestamp == timestamp) {
      toastr['warning'](`${timestamp} 已經新增過了，只能修改無法新增`);
      return 'exist';
    }
  }

  return 'not exist';
}

function resetAdd() {
  $('#addTempTable tbody').html(null);
  $('#addTable tbody').html(null);

  addData = {};
}

function checkAddData() {
  var count = 0;
  $.each(addData, function() {
    count++;
  });

  if(count == 0) {
    toastr['warning']('沒有新增項目');
    return 'zero';
  }

  return 'some';
}

function checkTimestampStatus() {
  var status = $('#currentEditCreationStatus').val();

  if(status != 'unlocked') {
    toastr['warning']('此筆紀錄已被鎖住，無法被編輯');
  }

  return status;
}
