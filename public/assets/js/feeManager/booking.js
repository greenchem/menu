$(function() {
  changeEvent();
  clickEvent();

  $('#period').change();
});

function changeEvent() {
  $('#period').unbind('change');
  $('#period').change(function() {
    var data = {};
    data._token = $('meta[name="csrf-token"]').attr('content');
    data.period_id = $('#period').val();

    $.get('/api/menu_sys/booking_log', data, function(log) {
      console.log(log);
    }).fail(function() {

    });
  });
}

function clickEvent() {
  $('.deleteBtn').unbind('click');
  $('.deleteBtn').click(function() {
    var id = $(this).data('id');
    var data = {};
    data._token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
      url: `/api/menu_sys/booling_log/${id}`,
      data: data,
      method: 'delete',
      success: function(result) {

      },
      fail: function() {

      }
    });
  });
}

function produceTable(log) {
  var text = '';
  var e;
  var name;
  var id;

  for(i=0; i<log.length; i++) {
    e = log[i];
    name = e['name'];
    id = e['id'];

    text += `<tr>`;
    text += `<td>${name}</td>`;
    text += `<td>`;
    text += `<button class="btn btn-danger deleteBtn" data-id="${id}">刪除</button>`
    text += `</td>`;
    text += `</tr>`;
  }

  $('#logTable tbody').html(text);
  clickEvent();
}

