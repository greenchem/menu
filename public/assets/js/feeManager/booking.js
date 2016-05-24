$(function() {
  init();
  changeEvent();
  clickEvent();

  $('#period').change();
});

var productData = {};

function init() {
  var temp = JSON.parse($('#productData').val());

  $.each(temp, function(idx, val) {
    productData[val.id] = val;
  });
}

function changeEvent() {
  $('#period').unbind('change');
  $('#period').change(function() {
    var data = {};
    data._token = $('meta[name="csrf-token"]').attr('content');
    data.period_id = $('#period').val();

    $.get('/api/menu_sys/booking_log', data, function(log) {
      console.log(log);
      produceTable(log);
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
      url: `/api/menu_sys/booking_log/${id}`,
      data: data,
      method: 'delete',
      success: function(result) {
        console.log(result);
        if(result.status == 0) {
          toastr['success']('刪除成功');
          $('#period').change();
        }
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
  var username;
  var nickname;
  var number;
  var price;
  var id;
  var product_id;
  var user_id;

  for(i=0; i<log.length; i++) {
    e = log[i];
    id = e['id'];
    price = e['price'];
    number = e['number'];
    product_id = e['product_id'];
    user_id = e['user_id'];

    name = productData[product_id]['name'];
    username = e.user.username;
    nickname = e.user.nickname;


    text += `<tr>`;
    text += `<td>${username}</td>`;
    text += `<td>${nickname}</td>`;
    text += `<td>${name}</td>`;
    text += `<td>${number}</td>`;
    text += `<td>${price}</td>`;
    text += `<td>`;
    text += `<button class="btn btn-danger deleteBtn" data-id="${id}">刪除</button>`
    text += `</td>`;
    text += `</tr>`;
  }

  $('#logTable tbody').html(text);
  clickEvent();
}

