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

// faker data
var menu;
var companyName = [
  '生科',
  '優好',
  '良農'
];
var festival = [
  '農曆新年',
  '元宵節',
  '清明節',
  '中秋節',
  '重陽節',
  '聖誕節'
];
var product = [
  '可樂',
  '雪碧',
  '披薩',
  '牛排',
  '冰箱',
  '餅乾',
  '人參',
  '高麗菜',
  '鮑魚',
  '蛋糕',
  '西堤餐卷'
];
var productUnit = [
  '一瓶',
  '一箱',
  '一片',
  '六盎司',
  '一台',
  '一盒',
  '一根',
  '一顆',
  '一尾',
  '一塊',
  '十二張'
];

function faker() {
  if(sessionStorage.menu != null) {
    menu = JSON.parse(sessionStorage.menu);
    return;
  }

  var i;
  var j;
  var k;
  var temp;
  var temp1;
  var festivalSum = 0;
  var productId = 0;

  menu = {};
  for(i=0; i<3; i++) {
    menu[i] = {};
    for(j=0; j<=i; j++) {
      menu[i][j] = {};
      menu[i][j]['name'] = `${companyName[i]} - ${festival[festivalSum]}`;
      menu[i][j]['list'] = {};

      temp = Math.floor(Math.random()*10 + 1);
      for(k=0; k<temp; k++) {
        temp1 = Math.floor(Math.random()*10 + 1);

        menu[i][j]['list'][k] = {};
        menu[i][j]['list'][k]['id'] = productId;
        menu[i][j]['list'][k]['name'] = product[temp1];
        menu[i][j]['list'][k]['unit'] = productUnit[temp1];
        menu[i][j]['list'][k]['price'] = Math.floor(Math.random()*1000 + 1);

        productId++;
      }
      festivalSum++;
      menu[i][j]['list'].length = temp;
      menu[i][j].length = j+1;
    }
  }

  menu.length = 3;
  sessionStorage.menu = JSON.stringify(menu);
  console.log('here');
}

