$(function() {
  faker();
  clickEvent();
});

function clickEvent() {
  $('.companyList').unbind('click');
  $('.companyList').click(function() {
    var company = $(this).data('company');
    produceMenu(company);

    // active status
    $('.companyList').removeClass('active');
    $(this).addClass('active');
  });

  $('.menuList').unbind('click');
  $('.menuList').click(function() {
    var company = $(this).data('company');
    var menu = $(this).data('menu');

    produceProduct(company, menu);
    // active status
    $('.menuList').removeClass('active');
    $(this).addClass('active');
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

function produceProduct(company, menu) {
  var i;
  var j;
  var text = '';
  var name;
  var unit;
  var price;

  for(i=0; menu[company][menu]['list'][i]!=null; i++) {
    console.log(i);
    name = menu[company][menu]['list'][i]['name'];
    unit = menu[company][menu]['list'][i]['unit'];
    price = menu[company][menu]['list'][i]['price'];

    text += `<tr>`;
    text += `<td>${name}</td>`;
    text += `<td>${unit}</td>`;
    text += `<td>${price}</td>`;
    text += `<select class="form-control ammount">`
    for(j=0; j<10; j++) {
      text += `<option>${j}</option`;
    }
    text += '</select>';
    text += '</tr>';
  }

  // append
  $('#productTable tbody').append(text);
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
  '蛋糕'
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
  '一塊'
];

function faker() {
  fakerList();
}

function fakerList() {
  var i;
  var j;
  var k;
  var temp;
  var temp1;
  var festivalSum = 0;
  var productId = 0;

  menu = [];
  for(i=0; i<3; i++) {
    menu[i] = [];
    for(j=0; j<=i; j++) {
      menu[i][j] = [];
      menu[i][j]['name'] = `${companyName[i]} - ${festival[festivalSum]}`;
      menu[i][j]['list'] = [];

      temp = Math.floor(Math.random()*10 + 1);
      for(k=0; k<temp; k++) {
        temp1 = Math.floor(Math.random()*10 + 1);

        menu[i][j]['list'][k] = [];
        menu[i][j]['list'][k]['id'] = productId;
        menu[i][j]['list'][k]['name'] = product[temp1];
        menu[i][j]['list'][k]['unit'] = productUnit[temp1];
        menu[i][j]['list'][k]['price'] = Math.floor(Math.random()*1000 + 1);

        productId++;
      }
      festivalSum++;
    }
  }
}

