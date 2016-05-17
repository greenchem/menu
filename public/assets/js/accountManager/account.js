$(function() {
  groupData = JSON.parse($('#groupData').val());

  clickEvent();
  getPeople();
});

var prevRole;
var currRole;
var people;
var groupData;

function changeEvent() {
  $('#selectCompany').unbind('change');
  $('#selectCompany').change(function() {
    var currCompany = $(this).val();
    var i;
    var selected = [];
    for(i=0; i<people.length; i++) {
      if(people[i].company_id == currCompany) {
        selected.push(people[i]);
      }
    }

    $('#menuTable tbody').html('');
    if(selected.length != 0) {
      produceTable(selected);
    }else {
      toastr['warning']('這間公司目前沒有人員');
    }
  });

  $('#addCompany').unbind('change');
  $('#addCompany').change(function() {
    var currCompany = $('#addCompany').val();
    var i;
    var text = '';
    var e;
    var id;
    var name;

    for(i=0; i<groupData.length; i++) {
      e = groupData[i];

      if(e.company_id == currCompany) {
        name = e.name;
        id = e.id;

        text += `<option value="${id}">${name}</option>`;
      }
    }

    $('#addGroup').html(text);
  });

  $('#editCompany').unbind('change');
  $('#editCompany').change(function() {
    var currCompany = $('#editCompany').val();
    var i;
    var text = '';
    var e;
    var id;
    var name;

    for(i=0; i<groupData.length; i++) {
      e = groupData[i];

      if(e.company_id == currCompany) {
        name = e.name;
        id = e.id;

        text += `<option value="${id}">${name}</option>`;
      }
    }

    $('#editGroup').html(text);
  });
}

function clickEvent() {
  $('#addModalBtn').unbind('click');
  $('#addModalBtn').click(function() {
    // reset
    $('#addUsername').val(null);
    $('#addPassword').val(null);
    $('#addNickname').val(null);
    $('#addCompany option:first').prop('selected', true);
    $('#addCompany').change();
    $('#addGroup option:first').prop('selected', true);
    $('#addPosition').val(null);

    $('#addAccount').modal('show');
  });

  $('#editBtn').unbind('click');
  $('#editBtn').click(function() {
    var id = $('#currentEditId').val();
    var data = {};
    data._token = $('meta[name="csrf-token"]').attr('content');
    data.username = $('#editUsername').val();
    data.nickname = $('#editNickname').val();
    data.position = $('#editPosition').val();

    var error = false;
    $.each(data, function(idx, val) {
      if(val == '') {
        error = true;
      }
    });
    if(error) {
      toastr['warning']('所有欄位都為必填');
      return;
    }


    data.company_id = $('#editCompany').val();
    data.group_id = $('#editGroup').val();

    $.ajax({
      url: `/api/account_sys/user/${id}`,
      data: data,
      method: 'put',
      success: function(result) {
        toastr['success']('編輯成功');
        $('#editAccount').modal('hide');
        getPeople();
      },
      fail: function() {
        toastr['error']('編輯失敗');
      }
    });
  });

  $('#addBtn').unbind('click');
  $('#addBtn').click(function() {
    var data = {};
    data._token = $('meta[name="csrf-token"]').attr('content');
    data.username = $('#addUsername').val();
    data.password = $('#addPassword').val();
    data.nickname = $('#addNickname').val();
    data.company_id = $('#addCompany').val();

    var error = false;
    $.each(data, function(idx, val) {
      if(val == '') {
        error = true;
      }
    });
    if(error) {
      toastr['warning']('所有欄位都為必填');
      return;
    }

    data.group_id = $('#addGroup').val();
    data.position = $('#addPosition').val();
    data.role_id = 5;// default User

    console.log(data);
    $.post('/api/account_sys/user', data, function(result) {
      console.log(result);
      if(result.status == 0) {
        toastr['success']('新增成功');
        $('#addAccount').modal('hide');
        getPeople();
      }else {
        toastr['error']('新增失敗, 可能是權限不足');
      }
    }).fail(function() {
      toastr['error']('新增失敗');
    });
  });

  $('#editRoleBtn').unbind('click');
  $('#editRoleBtn').click(function() {
    var id = $('#currentEditId').val();
    var data = {};
    data._token = $('meta[name="csrf-token"]').attr('content');

    currRole = [];
    $('input[name="role"]:checked').each(function() {
      var id = {
        'id':$(this).val()
      };
      currRole.push(id);
    });

    if(prevRole.length > 0) {// delete -> add
      roleDelete(id, prevRole, 0, prevRole.length);
    }else if(currRole.length > 0){// add
      roleAdd(id, currRole, 0, currRole.length);
    }else {
      toastr['warning']('沒有變動');
    }
  });
}

function getPeople() {
  var data = {};
  data._token = $('meta[name="csrf-token"]').attr('content');

  $('#menuTable tbody').html('');
  $.get('/api/account_sys/user/', data, function(result) {
    console.log(result);
    people = result;

    changeEvent();
    $('#selectCompany').change();
  }).fail(function() {
    toastr['error']('請先登入');
  });
}

function produceTable(people) {
  var i;// count
  var person;// temp variable
  var id;
  var username;
  var nickname;
  var company;
  var group;
  var index;
  var text = '';// text variable

  for(i=0; i<people.length; i++) {
    person = people[i];
    index = i;
    id = person['id'];
    username = person['username'];
    nickname = person['nickname'];
    company = person['company']['name'];
    group = person['group']['name'];

    text += `<tr>`;
    text += `<td>${username}</td>`;
    text += `<td>${nickname}</td>`;
    text += `<td>${company}</td>`;
    text += `<td>${group}</td>`;
    text += `<td>`;
    text += `<button class="btn btn-primary editModalBtn"`;
    text += `data-id="${id}"`;
    text += `>修改帳號資料</button>`;
    text += `<button class="btn btn-warning editRoleModalBtn"`
      text += `data-id="${id}"`
      text += `>修改帳號權限</button>`;
    text += `<button class="btn btn-danger deleteBtn" data-id="${id}">刪除</button>`;
    text += `</td>`;
    text += `</tr>`;
  }

  $('#menuTable tbody').html(text);
  tableEvent();
}

function tableEvent() {
  $('.deleteBtn').unbind('click');
  $('.deleteBtn').click(function() {
    var id = $(this).data('id');
    var index = $(this).data('index');
    //people.splice(index, 1);
    var data = {};
    data._token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
      url: `/api/account_sys/user/${id}`,
      data: data,
      method: 'delete',
      success: function(result) {
        console.log(result);
        toastr['success']('刪除成功');
        getPeople();
      },
      fail: function() {
        toastr['error']('刪除失敗');
      }
    });
  });

  $('.editModalBtn').unbind('click');
  $('.editModalBtn').click(function() {// account
    var username;
    var nickname;
    var group;
    var company;
    var position;
    var id = $(this).data('id');
    var data = {};
    data._token = $('meta[name="csrf-token"]').attr('content');

    $.get(`/api/account_sys/user/${id}`, data, function(result) {// person detail
      console.log(result);

      username = result.username;
      nickname = result.nickname;
      company = result.company_id;
      group = result.group_id;
      position = result.position;

      $('#editUsername').val(username);
      $('#editNickname').val(nickname);
      $('#editPosition').val(position);
      $(`#editCompany option[value="${company}"]`).prop('selected', true);
      $('#editCompany').change();
      $(`#editGroup option[value="${group}"]`).prop('selected', true);
      $('#currentEditId').val(id);
      $('#editAccount').modal('show');
    });
  });

  $('.editRoleModalBtn').unbind('click');
  $('.editRoleModalBtn').click(function() {
    var id = $(this).data('id');
    var data = {};
    data._token = $('meta[name="csrf-token"]').attr('content');

    $.get(`/api/account_sys/user/${id}`, data, function(result) {
      console.log(result);
      prevRole = result.roles;

      // diaplay checkbox
      $('input[name="role"]').prop('checked', false);
      $.each(result.roles, function(idx, val) {
        var id = val.id;
        $(`input[name="role"][value="${id}"]`).prop('checked', true);
      });

      $('#currentEditId').val(id);
      $('#editRole').modal('show');
    });
  });
}

function roleDelete(id, role, current_index, final_index) {
  var role_id = role[current_index].id;
  var data = {};
  data._token = $('meta[name="csrf-token"]').attr('content');
  $.ajax({
    url: `/api/account_sys/user/${id}/${role_id}`,
    data: data,
    method: 'delete',
    success: function(result) {
      if(current_index+1 != final_index) {
        roleDelete(id, role, current_index+1, final_index);
      }else {
        if(currRole.length > 0) {
          roleAdd(id, currRole, 0, currRole.length);
        }else {
          $('#editRole').modal('hide');
          toastr['success']('更新權限成功');
        }
      }
    },
    fail: function() {

    }
  });
}

function roleAdd(id, role, current_index, final_index) {
  var role_id = role[current_index].id;
  var data = {};
  data._token = $('meta[name="csrf-token"]').attr('content');

  $.ajax({
    url: `/api/account_sys/user/${id}/${role_id}`,
    data: data,
    method: 'put',
    success: function(result) {
      if(current_index+1 != final_index) {
        roleAdd(id, role, 0, current_index+1, final_index);
      }else {
        toastr['success']('更新權限成功');
        $('#editRole').modal('hide');
      }
    },
    fail: function() {

    }
  });
}

/*
 * If Need Page, Add Money
 * Money Money
 *
 function producePage() {
 var i;
 var minPage = Math.max(currentPage - 5, 0);
 var maxPage = Math.min(minPage + 10, finalPage);
 var text = '';

// previous
if(currentPage != 0) {
text += `<li id="prevBtn"><a><span>&laquo;</span></a></li>`;
}else {
text += `<li class="disabled"><a><span>&laquo;</span></a></li>`;
}
// page number
for(i=minPage; i<=maxPage; i++) {
if(i==currentPage) {
text += `<li class="pageBtn active" data-page="${i}"><a>${i+1}</a></li>`;
}else {
text += `<li class="pageBtn" data-page="${i}"><a>${i+1}</a></li>`;
}
}
// next
if(currentPage != finalPage) {
text += `<li id="nextBtn"><a><span>&raquo;</span></a></li>`;
}else {
text += `<li class="disabled"><a><span>&raquo;</span></a></li>`;
}

$('.pagination').html(text);
pageEvent();
}

function pageEvent() {
$('.pageBtn').unbind('click');
$('.pageBtn').click(function() {
currentPage = $(this).data('page');
getPeople();
});

$('#nextBtn').unbind('click');
$('#nextBtn').click(function() {
currentPage++;
getPeople();
});

$('#prevBtn').unbind('click');
$('#prevBtn').click(function() {
currentPage--;
getPeople();
});
}

*/

