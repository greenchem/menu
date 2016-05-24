$(function() {
  init();
  clickEvent();
  calQuota();
});

var shoppingList;
var quota = 20000;

function init() {
  if(sessionStorage.shoppingList != null) {
    shoppingList = JSON.parse(sessionStorage.shoppingList);
  }else {
    shoppingList = {};
  }
}

function calQuota() {
  var sum = 0;
  var price;
  var value;

  $.each(shoppingList, function(idx) {
    price = shoppingList[idx]['price'];
    value = shoppingList[idx]['value'];

    sum += price*value;
  });

  $('#quota').html(quota-sum);
}

function clickEvent() {
  $('.companyList').unbind('click');
  $('.companyList').click(function() {
    var target = $(this);
    var data = {};
    data._token = $('meta[name="csrf-token"]').attr('content');
    data.company_id = $(this).data('company');

    $('#productTable tbody').html(null);
    $.get('/api/menu_sys/menu/', data, function(menu) {
      console.log(menu);
      produceMenu(menu);

      // active status
      $('.companyList').removeClass('active');
      target.addClass('active');

      // flag
      $('#currentCompany').val(data.company_id);
      $('#currentMenu').val(null);
    }).fail(function() {

    });
  });

  $('.menuList').unbind('click');
  $('.menuList').click(function() {
    var target = $(this);
    var data = {};
    data._token = $('meta[name="csrf-token"]').attr('content');
    data.menu_id = $(this).data('id');

    $.get('/api/menu_sys/product', data, function(product) {
      console.log(product);
      produceProduct(product);
      // active status
      $('.menuList').removeClass('active');
      target.addClass('active');
    }).fail(function() {

    });
  });

  $('#shoppingCartBtn').unbind('click');
  $('#shoppingCartBtn').click(function() {
    var accessFlag = 'not';

    $('.amount').each(function() {
      var value = $(this).val();
      if(value==0) {// not select
        return;
      }
      accessFlag = 'yes';
      var id = $(this).data('id');
      var name = $(this).data('name');
      var unit = $(this).data('unit');
      var price = $(this).data('price');

      if(shoppingList[id]!=null) {
        shoppingList[id]['value'] = parseInt(shoppingList[id]['value']) + parseInt(value);
      }else {
        shoppingList[id] = {};
        shoppingList[id]['name'] = name;
        shoppingList[id]['unit'] = unit;
        shoppingList[id]['price'] = price;
        shoppingList[id]['value'] = value;
      }
      console.log(id, name, unit, value);
        console.log(shoppingList);
    });

    // store sessionStorage
    if(accessFlag == 'not') {
      toastr['warning']('沒有選擇任何商品');
    }else {
      sessionStorage.shoppingList = JSON.stringify(shoppingList);
      toastr['success']('成功加入購物車');
    }

    calQuota();
  });
}

function produceMenu(menu) {
  var i;
  var text = '';
  var e;
  var id;
  var name;

  for(i=0; i<menu.length; i++) {
    e = menu[i];
    name = e['name'];
    id = e['id'];

    text += `<button class="btn btn-default menuList"`;
    text += `data-id="${id}">${name}</button>`;
  }

  // append
  $('#menuList').html(text);
  // rebind event
  clickEvent();
}

function produceProduct(product) {
  var i;
  var j;
  var text = '';
  var e;
  var id;
  var name;
  var unit;
  var price;

  for(i=0; i<product.length; i++) {
    e = product[i];
    id = e['id'];
    name = e['name'];
    unit = e['unit_type'];
    price = e['price'];

    text += `<tr>`;
    text += `<td>${name}</td>`;
    text += `<td>${unit}</td>`;
    text += `<td>${price}</td>`;
    text += `<td><select class="form-control amount"`;
    text += `data-id="${id}"`;
    text += `data-name="${name}"`;
    text += `data-unit="${unit}"`;
    text += `data-price="${price}"`;
    text += `>`
      for(j=0; j<100; j++) {
        text += `<option value="${j}">${j}</option>`;
      }
    text += '</select></td>';
    text += '</tr>';
  }

  // append
  $('#productTable tbody').html(text);
  // rebind event
  clickEvent();
}

