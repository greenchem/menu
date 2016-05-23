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
  var status = $('#currentEditCreationStatus').val();
  var text = '';
  var i;
  var e;
  var id;
  var username;
  var nickname;
  var fee;

  for(i=0; i<log.length; i++) {
    e = log[i];
    id = e.user_id;
    fee = e.fee;
    username = e.user.username;
    nickname = e.user.nickname;

    text += `<tr>`;
    text += `<td>${username}</td>`;
    text += `<td>${nickname}</td>`;
    text += `<td>`;
    if(status == 'unlocked') {
      text += `<input type="text" class="form-control editFee" value="${fee}"`;
      text += `data-id="${id}">`;
    }else {
      text += `<input type="text" class="form-control editFee" value="${fee}" disabled>`;
    }
    text += `</td>`;
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

