$(function() {
  changeEvent();
  $('#period').change();
});

function changeEvent() {
  $('#period').unbind('change');
  $('#period').change(function() {
    var data = {};
    data._token = $('meta[name="csrf-token"]').attr('content');
    data.period_id = $('#period').val();
    data.user_id = $('#user_id').val();

    console.log(data);
    $.get('/api/menu_sys/booking_log', data, function(history) {
      console.log(history);

      produceTable(history);
    }).fail(function() {

    });
  });
}

function produceTable(history) {
  var i;
  var text = '';
  var e;
  var id;
  var name;
  var number;
  var price;
  var unit_type;
  var unit_pricel
  var status;

  for(i=0; i<history.length; i++) {
    e = history[i];
    id = e.product_id;
    price = e.price;
    status = e.status;
    number = e.number;

    name = e.product['name'];
    unit_type = e.product['unit_type'];
    unit_price = e.product['price'];

    text += `<tr>`;
    text += `<td>${name}</td>`;
    text += `<td>${unit_type}</td>`;
    text += `<td>${number}</td>`;
    text += `<td>${unit_price}</td>`;
    text += `<td>${price}</td>`;
    if(status == 'confirmed') {
      text += `<td><button class="btn btn-success">已銷帳</button></td>`;
    }else {
      text += `<td><button class="btn btn-warning">未核銷</button></td>`;
    }
    text += `</tr>>`;
  }

  $('#menuTable').html(text);
}

