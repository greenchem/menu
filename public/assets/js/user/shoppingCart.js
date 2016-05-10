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
      for(j=0; j<30; j++) {
        text += `<option>${j}</option>`;
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
}

function clickEvent() {
  $('#submitBtn').unbind('click');
  $('#submitBtn').click(function() {
    return;
    $.post();
  });

  $('.deleteBtn').unbind('click');
  $('.deleteBtn').click(function() {
    var index = $(this).data('index');
    delete shoppingList[index];
    $(this).parent().parent().remove();
    sessionStorage.shoppingList = JSON.stringify(shoppingList);
  });
}

