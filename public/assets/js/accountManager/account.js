$(function() {
  var data = {};
  data._token = $('meta[name="csrf-token"]').attr('content');

  $.get('/api/account_sys/company/', data, function(company) {// get company list
    $.get('/api/account_sys/group/', data, function(group) {// get group list
      initSelect(company, group);

      clickEvent();
      getPeople();
    });
  });
});

function initSelect(company, group) {
  var text = '';
  var i;
  var e;// element
  var id;
  var name;

  for(i=0; i<company.length; i++) {// append company
    e = company[i];
    id = e.id;
    name = e.name;

    text = `<option value="${id}">${name}</option>`;

    $('#addCompany').append(text);
    $('#editCompany').append(text);
  }

  for(i=0; i<group.length; i++) {// append group
    e = group[i];
    id = e.id;
    name = e.name;

    text = `<option value="${id}">${name}</option>`;

    $('#addGroup').append(text);
    $('#editGroup').append(text);
  }
}

function clickEvent() {
  $('#addModalBtn').unbind('click');
  $('#addModalBtn').click(function() {
    $('#addAccount').modal('show');
  });

  $('#editBtn').unbind('click');
  $('#editBtn').click(function() {
    return;
    var id = $('#currentEditId').val();
    var data = {};
    data._token = $('meta[name="csrf-token"]').attr('content');
    data.nickname = $('#editNickname').val();
    data.company_id = $('#editCompany').val();
    data.group_id = $('#editGroup').val();

    $.ajax({
      url: `/api/account_sys/user/${id}`,
      data: data,
      method: 'put',
      success: function(result) {
        toastr['success']('編輯成功');
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
    data.group_id = $('#addGroup').val();
    data.role_id = 5;// default User

    console.log(data);
    $.post('/api/account_sys/user', data, function(result) {
      console.log(result);
      if(result.status == 0) {
        toastr['success']('新增成功');
      }else {
        toastr['error']('新增失敗, 可能是權限不足');
      }
    }).fail(function() {
      toastr['error']('新增失敗');
    });
  });

  $('#editRoleBtn').unbind('click');
  $('#editRoleBtn').click(function() {
    var data = {};
    data._token = $('meta[name="csrf-token"]').attr('content');

    var role = [];
    $('input[name="role"]:checked').each(function() {
      role.push($(this).val());
    });

    role.each(function(idx, val) {
      $.ajax({
        url: `/api/account_sys/`,
        data: data,
        method: 'put',
        success: function(result) {

        },
        fail: function() {

        }
      });
    });
  });
}

function getPeople() {
  var data = {};
  data._token = $('meta[name="csrf-token"]').attr('content');

  $.get('/api/account_sys/user/', data, function(result) {
    console.log(result);
    produceTable(result);
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
      },
      fail: function() {
        toastr['error']('刪除失敗');
      }
    });
  });

  $('.editModalBtn').unbind('click');
  $('.editModalBtn').click(function() {
    var username;
    var nickname;
    var group;
    var company;
    var id = $(this).data('id');
    var data = {};
    data._token = $('meta[name="csrf-token"]').attr('content');

    $.get(`/api/account_sys/user/${id}`, data, function(result) {// person detail
      console.log(result);

      username = result.username;
      nickname = result.nickname;
      company = result.company_id;
      group = result.group_id;

      $('#editUsername').val(username);
      $('#editNickname').val(nickname);
      $(`#editCompany option[value="${company}"]`).prop('selected', true);
      $(`#editGroup option[value="${group}"]`).prop('selected', true);
      $('#editAccount').modal('show');
    });
  });

  $('.editRoleModalBtn').unbind('click');
  $('.editRoleModalBtn').click(function() {
    var id = $(this).data('id');
    var data = {};
    data._token = $('meta[name="csrf-token"]').attr('content');


    $.get(`/api/account_sys/role/${id}`, data, function(result) {
      console.log(result);
      $('#editRole').modal('show');
    });
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

