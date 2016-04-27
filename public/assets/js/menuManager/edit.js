$(function() {
  clickEvent();
});

var editTarget;

function clickEvent() {
  $('#addModalBtn').unbind('click');
  $('#addModalBtn').click(function() {
    $('#addElement').modal('show');
  });

  $('.editModalBtn').unbind('click');
  $('.editModalBtn').click(function() {
    // get value
    var name = $(this).data('name');
    var unit = $(this).data('unit');
    var number = $(this).data('number');
    var price = $(this).data('price');

    // insert value
    $('#editName').val(name);
    $('#editUnit').val(unit);
    $('#editNumber').val(number);
    $('#editPrice').val(price);

    $('#editElement').modal('show');
    //record where change
    editTarget = $(this).parent().parent();
  });

  $('#addElementBtn').unbind('click');
  $('#addElementBtn').click(function() {
    var name = _.trim($('#addName').val());
    var unit = _.trim($('#addUnit').val());
    var number = _.trim($('#addNumber').val());
    var price = _.trim($('#addPrice').val());
    var text = '';

    if(name=='' || unit=='' || number=='' || price=='') {
      toastr['warning']('所有欄位都必須填寫才能新增，且不得為空');
      return;
    }

    text += `<tr>`;
    text += `<td>${name}</td>`;
    text += `<td>${unit}</td>`;
    text += `<td>${number}</td>`
    text += `<td>${price}</td>`;
    text += `<td>`;
    text += `<button class="btn btn-primary editModalBtn"`;
    text += `data-name="${name}"`;
    text += `data-unit="${unit}"`;
    text += `data-number="${number}"`;
    text += `data-price="${price}"`;
    text += `>編輯</button>`;
    text += `<button class="btn btn-danger deleteBtn">刪除</button>`
    text += `</td>`;
    text += `</tr>`;

    $('#menuTable tbody').append(text);
    $('#addElement').modal('hide');
    clickEvent();
  });

  $('#editElementBtn').unbind('click');
  $('#editElementBtn').click(function() {
    var name = _.trim($('#editName').val());
    var unit = _.trim($('#editUnit').val());
    var number = _.trim($('#editNumber').val());
    var price = _.trim($('#editPrice').val());
    var text = '';

    if(name=='' || unit=='' || number=='' || price=='') {
      toastr['warning']('所有欄位都必須填寫才能修改，且不得為空');
      return;
    }

    text += `<td>${name}</td>`;
    text += `<td>${unit}</td>`;
    text += `<td>${number}</td>`
    text += `<td>${price}</td>`;
    text += `<td>`;
    text += `<button class="btn btn-primary editModalBtn"`;
    text += `data-name="${name}"`;
    text += `data-unit="${unit}"`;
    text += `data-number="${number}"`;
    text += `data-price="${price}"`;
    text += `>編輯</button>`;
    text += `<button class="btn btn-danger deleteBtn">刪除</button>`
    text += `</td>`;

    editTarget.html(text);
    $('#editElement').modal('hide');
    clickEvent();
  });

  $('.deleteBtn').unbind('click');
  $('.deleteBtn').click(function() {
    $(this).parent().parent().remove();
  });
}

