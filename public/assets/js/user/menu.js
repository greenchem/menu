$(function() {
  faker();
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
    var company = $(this).data('company');
    produceMenu(company);

    // active status
    $('.companyList').removeClass('active');
    $(this).addClass('active');
    // flag
    $('#currentCompany').val(company);
    $('#currentMenu').val(null);
  });

  $('.menuList').unbind('click');
  $('.menuList').click(function() {
    var company = $(this).data('company');
    var menu = $(this).data('menu');

    produceProduct(company, menu);
    // active status
    $('.menuList').removeClass('active');
    $(this).addClass('active');
    // flag
    $('#currentMenu').val(menu);
  });

  $('#shoppingCartBtn').unbind('click');
  $('#shoppingCartBtn').click(function() {
    var currentCompany = $('#currentCompany').val();
    var currentMenu = $('#currentMenu').val();
    var accessFlag = 'not';

    if(_.trim(currentCompany)=='' || _.trim(currentMenu)=='') {
      toastr['warning']('請先選擇公司跟菜單');
      return;
    }

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
        shoppingList[id]['value'] += value;
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

function produceMenu(company) {
  var i;
  var text = '';
  var name;

  for(i=0; menu[company][i]!=null; i++) {
    name = menu[company][i]['name'];
    text += `<button class="btn btn-default menuList"`;
    text += `data-company="${company}"`;
    text += `data-menu="${i}">`;
    text += `${name}</button>`
  }

  // append
  $('#menuList').html(text);
  // rebind event
  clickEvent();
}

function produceProduct(company, menu_id) {
  var i;
  var j;
  var text = '';
  var list;
  var id;
  var name;
  var unit;
  var price;

  for(i=0; i<menu[company][menu_id]['list'].length; i++) {
    list = menu[company][menu_id]['list'][i];
    id = list['id'];
    name = list['name'];
    unit = list['unit'];
    price = list['price'];

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
      for(j=0; j<10; j++) {
        text += `<option>${j}</option>`;
      }
    text += '</select></td>';
    text += '</tr>';
  }

  // append
  $('#productTable tbody').html(text);
  // rebind event
  clickEvent();
}

