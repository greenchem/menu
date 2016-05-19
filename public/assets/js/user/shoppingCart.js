$(function() {
  init();
});

var shoppingList;

function init() {
  if(sessionStorage.shoppingList != null) {
    shoppingList = JSON.parse(sessionStorage.shoppingList);
  }else {
    shoppingList = {};
  }

  console.log(shoppingList);
  produceShoppingTable();
}

function produceShoppingTable() {
  var i;
  var j;
  var text = '';
  var list;
  var id;
  var name;
  var unit;
  var price;
  var value;

  $.each(shoppingList, function(idx) {
    list = shoppingList[idx];

    id = idx;
    name = list['name'];
    unit = list['unit'];
    price = list['price'];
    value = list['value'];

    text = `<tr>`;
    text += `<td>${name}</td>`;
    text += `<td>${unit}</td>`;
    text += `<td>${price}</td>`;
    text += `<td><select class="form-control amount"`;
    text += `data-id="${id}"`;
    text += `data-name="${name}"`;
    text += `data-unit="${unit}"`;
    text += `data-price="${price}"`;
    text += `>`
      for(j=1; j<100; j++) {
        text += `<option value="${j}">${j}</option>`;
      }
    text += `</select></td>`;
    text += `<td><button class="btn btn-danger deleteBtn" data-index="${idx}">刪除</button></td>`;
    text += `</tr>`;

    // append
    $('#productTable tbody').append(text);
    $('#productTable tbody tr:last select').val(value);
  });

  // rebind event
  clickEvent();
  changeEvent();
}

function clickEvent() {
  $('#submitBtn').unbind('click');
  $('#submitBtn').click(function() {

    var buyPros = [];
    $.each(shoppingList, function(idx, val) {
      var e = {};
      e.id = idx;
      e.value = val['value'];
      e.name = val['name'];

      buyPros.push(e);
    });
    console.log(buyPros);

    if(buyPros.length > 0) {
      buyProduct(buyPros, 0, buyPros.length);
    }else {
      toastr['warning']('購物車裏面沒有東西');
    }
  });

  $('.deleteBtn').unbind('click');
  $('.deleteBtn').click(function() {
    var index = $(this).data('index');
    delete shoppingList[index];
    $(this).parent().parent().remove();
    sessionStorage.shoppingList = JSON.stringify(shoppingList);
  });
}

function changeEvent() {
  $('.amount').unbind('change');
  $('.amount').change(function() {
    var index = $(this)
      .parent().parent()
      .find('.deleteBtn')
      .data('index');

    shoppingList[index]['value'] = $(this).val();
    sessionStorage.shoppingList = JSON.stringify(shoppingList);
  });
}

function buyProduct(product, current_index, final_index) {
  var e = product[current_index];
  var data = {};
  data._token = $('meta[name="csrf-token"]').attr('content');
  data.product_id = e.id;
  data.number = e.value;

  $.post('/api/menu_sys/booking_log', data, function(result) {
    if(result.status == 3) {
      console.log(data);
      toastr['warning'](`您買太多 ${e.name} 請減少購買數量，不過此商品仍有可能是已被搶購一空`);
    }else if(result.status == 2){
      toastr['warning'](`這項商品 ${e.name} 沒有開放購買`);
    }else {
      delete shoppingList[data.product_id];
      sessionStorage.shoppingList = JSON.stringify(shoppingList);
    }

    if(current_index+1 != final_index) {
      buyProduct(product, current_index+1, final_index);
    }else {
      finish();
    }
  }).fail(function() {

  });
}

function finish() {
  toastr['success']('購買完成，將幫您重整購物車');

  setTimeout(function() {
    window.location.reload();
  }, 3000);
}

