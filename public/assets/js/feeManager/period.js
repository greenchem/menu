$(function() {
  getPeriod();
  clickEvent();
});

function getPeriod() {
  var data = {};
  data._token = $('meta[name="csrf-token"]').attr('content');

  $.get('/api/menu_sys/period', data, function(period) {
    console.log(period);
    produceTable(period);
  }).fail(function() {

  });
}

function clickEvent() {
  $('#addModalBtn').unbind('click');
  $('#addModalBtn').click(function() {
    $('#addName').val(null);

    $('#addPeriodModal').modal('show');
  });

  $('.editModalBtn').unbind('click');
  $('.editModalBtn').click(function() {
    var name = $(this).data('name');
    var id = $(this).data('id');
    var status = $(this).data('status');

    $('#editName').val(name);
    $(`#editStatus option[value="${status}"]`).prop('selected', true);

    $('#currentEditId').val(id);
    $('#editPeriodModal').modal('show');
  });

  $('#addPeriodBtn').unbind('click');
  $('#addPeriodBtn').click(function() {
    var data = {};
    data._token = $('meta[name="csrf-token"]').attr('content');
    data.name = $('#addName').val();
    data.status = 'invisible';

    $.post('/api/menu_sys/period', data, function(result) {
      console.log(result);
      getPeriod();
      $('#addPeriodModal').modal('hide');

      toastr['success']('新增成功');
    }).fail(function() {

    });
  });

  $('#editPeriodBtn').unbind('click');
  $('#editPeriodBtn').click(function() {
    var id = $('#currentEditId').val();
    var data = {};
    data._token = $('meta[name="csrf-token"]').attr('content');
    data.name = $('#editName').val();
    data.status = $('#editStatus').val();

    $.ajax({
      url: `/api/menu_sys/period/${id}`,
      data: data,
      method: 'put',
      success: function(result) {
        console.log(result);
        getPeriod();
        $('#editPeriodModal').modal('hide');

        toastr['success']('編輯成功');
      },
      fail: function() {

      }
    });
  });

  $('.deleteBtn').unbind('click');
  $('.deleteBtn').click(function() {
    var id = $(this).data('id');
    var data = {};
    data._token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
      url: `/api/menu_sys/period/${id}`,
      data: data,
      method: 'delete',
      success: function(result) {
        toastr['success']('刪除成功');
        getPeriod();
      },
      fail: function() {

      }
    });
  });
}

function produceTable(period) {
  var text = '';
  var e;
  var name;
  var id;
  var status;

  for(i=0; i<period.length; i++) {
    e = period[i];
    name = e['name'];
    id = e['id'];
    status = e['status'];

    text += `<tr>`;
    text += `<td>${name}</td>`;
    text += `<td>`;
    text += `<button class="btn btn-primary editModalBtn"`
    text += `data-name="${name}"`;
    text += `data-id="${id}"`;
    text += `data-status="${status}">`;
    text += `編輯</button>`;
    text += `<button class="btn btn-danger deleteBtn" data-id="${id}">刪除</button>`
    text += `</td>`;
    text += `</tr>`;
  }

  $('#periodTable tbody').html(text);
  clickEvent();
}

