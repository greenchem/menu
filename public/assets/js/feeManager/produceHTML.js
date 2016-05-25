function produceAddTempTable() {
  // env
  var company = $('#addCompany').val();
  var group = $('#addGroup').val();

  var text = '';
  var i;
  var e;
  var id;
  var username;
  var nickname;
  var position;

  for(i=0; i<peopleData.length; i++) {
    e = peopleData[i];
    if(company != e.company_id || group != e.group_id) {
      continue;
    }

    id = e.id;
    username = e.username;
    nickname = e.nickname;
    position = e.position;

    text += `<tr>`;
    text += `<td>${username}</td>`;
    text += `<td>${nickname}</td>`;
    text += `<td>${position}</td>`;
    text += `<td>`;
    text += `<input type="text" class="form-control addTempFee" placeholder="金額" value="0"`;
    text += `data-id="${id}">`;
    text += `</td>`;
    text += `<td><button class="btn btn-danger deleteAddTempFee">刪除</button></td>`;
    text += `</tr>`;
  }

  $('#addTempTable tbody').html(text);
  clickEvent();
}

function produceEditTempTable(log) {
  var status = $('#currentEditCreationStatus').val();
  var text = '';
  var i;
  var e;
  var id;
  var username;
  var nickname;
  var position;
  var fee;

  for(i=0; i<log.length; i++) {
    e = log[i];
    id = e.user_id;
    fee = e.fee;
    username = e.user.username;
    nickname = e.user.nickname;
    position = e.user.position;

    text += `<tr>`;
    text += `<td>${username}</td>`;
    text += `<td>${nickname}</td>`;
    if(status == 'unlocked') {
      text += `<td>`;
      text += `<input type="text" class="form-control editTempFee" value="${fee}"`;
      text += `data-id="${id}">`;
      text += `</td>`;
      text += `<td><button class="btn btn-danger deleteEditTempFee">刪除</button></td>`;
    }else {
      text += `<td>`;
      text += `<input type="text" class="form-control" value="${fee}" disabled>`;
      text += `</td>`;
      text += `<td></td>`;
    }
    text += `</tr>`;
  }

  $('#editTempTable tbody').html(text);
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

function produceTimestamp() {
  var i;
  var e;
  var id;
  var timestamp;
  var status;
  var text = '';

  for(i=0; i<creationData.length; i++) {
    e = creationData[i];
    id = e.id;
    timestamp = e.timestamp;
    status = e.status;

    text += `<option value="${id}" data-status="${status}">${timestamp}</option>`;
  }

  $('#editTimestamp').html(text);
}

function appendToAddTable() {
  var username;
  var nickname;
  var position;
  var text = '';

  $.each(addData, function(idx, val) {
    console.log(idx);
    username = peopleDataById[idx].username;
    nickname = peopleDataById[idx].nickname;
    position = peopleDataById[idx].position;

    text += `<tr>`;
    text += `<td>${username}</td>`;
    text += `<td>${nickname}</td>`;
    text += `<td>${position}</td>`;
    text += `<td>${val.fee}</td>`;
    text += `<td><button class="btn btn-danger deleteAddFee" data-id="${idx}">刪除</button></td>`;
    text += `</tr>`;
  });

  $('#addTable tbody').html(text);
  clickEvent();
}

function appendToEditTable() {

}

