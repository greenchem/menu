$(function() {
  faker();
  produceTable();
  clickEvent();
});

var periodData;

function clickEvent() {
  $('#addModalBtn').unbind('click');
  $('#addModalBtn').click(function() {
    $('#addPeriodModal').modal('show');
  });

  $('.editModalBtn').unbind('click');
  $('.editModalBtn').click(function() {
    var name = $(this).data('name');
    var id = $(this).data('id');

    $('#editPeriod').val(name);

    $('#editPeriodModal').modal('show');
  });

  $('.deleteBtn').unbind('click');
  $('.deleteBtn').click(function() {

  });
}

function produceTable() {
  var text = '';
  var list;
  var name;
  var id;

  for(i=0; i<periodData.length; i++) {
    list = periodData[i];
    name = list['name'];
    id = list['id'];

    text += `<tr>`;
    text += `<td>${name}</td>`;
    text += `<td>`;
    text += `<button class="btn btn-primary editModalBtn"`
    text += `data-name="${name}"`;
    text += `data-id="${id}">`;
    text += `編輯</button>`;
    text += `<button class="btn btn-danger deleteBtn" data-id="${id}">刪除</button>`
    text += `</td>`;
    text += `</tr>`;
  }

  $('#periodTable tbody').html(text);

}

function faker() {
  var i;
  periodData = [];
  for(i=0; i<5; i++) {
    periodData[i] = [];
    periodData[i]['name'] = `2016-${i+1}`;
    periodData[i]['id'] = i;
  }
}

