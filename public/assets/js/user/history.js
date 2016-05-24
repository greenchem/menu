$(function() {
  init();
  changeEvent();
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

  for(i=0; i<history.length; i++) {
    e = history[i];
    id = e.product_id;
    price = e.price;
    number = e.number;

    name = productData[id]['name'];
    unit_type = productData[id]['unit_type'];
    unit_price = productData[id]['price'];

    text += `<tr>`;
    text += `<td>${name}</td>`;
    text += `<td>${unit_type}</td>`;
    text += `<td>${number}</td>`;
    text += `<td>${unit_price}</td>`;
    text += `<td>${price}</td>`;
    text += `</tr>>`;
  }

  $('#menuTable').html(text);
}

