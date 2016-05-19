$(function() {
  getMenu();
});

var editTarget;
var oldPros;
var updatePros = [];
var deletePros = [];
var addPros = [];

function getMenu() {
  var data = {};
  data._token = $('meta[name="csrf-token"]').attr('content');
  data.menu_id = $('#menu_id').val();

  $.get(`/api/menu_sys/product/`, data, function(products) {
    console.log(products);
    oldPros = products;
    var i;
    var text = '';
    var e;
    var name;
    var unit;
    var price;
    var inventory;
    var description;

    for(i=0; i<products.length; i++) {
      e = products[i];
      name = e.name;
      unit = e.unit_type;
      price = e.price;
      inventory = e.inventory;
      description = e.description;

      text += `<tr>`;
      text += `<td>${name}</td>`;
      text += `<td>${unit}</td>`;
      text += `<td>${inventory}</td>`
      text += `<td>${price}</td>`;
      text += `<td>${description}</td>`;
      text += `<td>`;
      text += `<button class="btn btn-primary editModalBtn"`;
      text += `data-name="${name}"`;
      text += `data-unit="${unit}"`;
      text += `data-inventory="${inventory}"`;
      text += `data-price="${price}"`;
      text += `data-description="${description}"`;
      text += `>編輯</button>`;
      text += `<button class="btn btn-danger deleteBtn">刪除</button>`
      text += `</td>`;
      text += `</tr>`;
    }

    $('#menuTable tbody').html(text);
    clickEvent();
  });
}

function clickEvent() {
  $('#addModalBtn').unbind('click');
  $('#addModalBtn').click(function() {
    $('#addElement input[type="text"]').val(null);
    $('#addInventory').val(0);
    $('#addElement').modal('show');
  });

  $('.editModalBtn').unbind('click');
  $('.editModalBtn').click(function() {
    // get value
    var name = $(this).data('name');
    var unit = $(this).data('unit');
    var inventory = $(this).data('inventory');
    var price = $(this).data('price');
    var description = $(this).data('description');

    // insert value
    $('#editName').val(name);
    $('#editUnit').val(unit);
    $('#editInventory').val(inventory);
    $('#editPrice').val(price);
    $('#editDescription').val(description);

    $('#editElement').modal('show');
    //record where change
    editTarget = $(this).parent().parent();
  });

  $('#addElementBtn').unbind('click');
  $('#addElementBtn').click(function() {
    var name = _.trim($('#addName').val());
    var unit = _.trim($('#addUnit').val());
    var inventory = _.trim($('#addInventory').val());
    var price = _.trim($('#addPrice').val());
    var description = _.trim($('#addDescription').val());
    var text = '';

    if(name=='' || unit=='' || inventory=='' || price=='') {
      toastr['warning']('所有欄位都必須填寫才能新增，且不得為空');
      return;
    }

    text += `<tr>`;
    text += `<td>${name}</td>`;
    text += `<td>${unit}</td>`;
    text += `<td>${inventory}</td>`
    text += `<td>${price}</td>`;
    text += `<td>${description}</td>`;
    text += `<td>`;
    text += `<button class="btn btn-primary editModalBtn"`;
    text += `data-name="${name}"`;
    text += `data-unit="${unit}"`;
    text += `data-inventory="${inventory}"`;
    text += `data-price="${price}"`;
    text += `data-description="${description}"`;
    text += `>編輯</button>`;
    text += `<button class="btn btn-danger deleteBtn">刪除</button>`;
    text += `</td>`;
    text += `</tr>`;

    $('#menuTable tbody').append(text);
    $('#addElement').modal('hide');
    clickEvent();
  });

  $('#editElementBtn').unbind('click');
  $('#editElementBtn').click(function() {
    var name = _.trim($('#editName').val());
    var unit = _.trim($('#editUnit').val());
    var inventory = _.trim($('#editInventory').val());
    var price = _.trim($('#editPrice').val());
    var description = _.trim($('#editDescription').val());
    var text = '';

    if(name=='' || unit=='' || inventory=='' || price=='') {
      toastr['warning']('所有欄位都必須填寫才能修改，且不得為空');
      return;
    }

    text += `<td>${name}</td>`;
    text += `<td>${unit}</td>`;
    text += `<td>${inventory}</td>`
    text += `<td>${price}</td>`;
    text += `<td>${description}</td>`;
    text += `<td>`;
    text += `<button class="btn btn-primary editModalBtn"`;
    text += `data-name="${name}"`;
    text += `data-unit="${unit}"`;
    text += `data-inventory="${inventory}"`;
    text += `data-price="${price}"`;
    text += `data-description="${description}"`;
    text += `>編輯</button>`;
    text += `<button class="btn btn-danger deleteBtn">刪除</button>`;
    text += `</td>`;

    editTarget.html(text);
    $('#editElement').modal('hide');
    clickEvent();
  });

  $('.deleteBtn').unbind('click');
  $('.deleteBtn').click(function() {
    $(this).parent().parent().remove();
  });

  $('#editMenuBtn').unbind('click');
  $('#editMenuBtn').click(function() {
    var data = {};
    data._token = $('meta[name="csrf-token"]').attr('content');
    data.menu_id = $('#menu_id').val();

    console.log(data);
    $.ajax({// Before Add New Data, Delete All Data
      url: `/api/menu_sys/product/list`,
      data: data,
      method: 'delete',
      success: function(result) {// Start Insert
        console.log(result);
        data.products = [];
        $('.editModalBtn').each(function() {
          var e = {};
          e['name'] = $(this).data('name');
          e['unit_type'] = $(this).data('unit');
          e['inventory'] = $(this).data('inventory');
          e['price'] = $(this).data('price');
          e['description'] = $(this).data('description');
          e['menu_id'] = data.menu_id;

          console.log('e', e);
          data.products.push(e);
          console.log(data.products);
        });

        // JSON encode
        data.products = JSON.stringify(data.products);
        console.log('output data', data);
        $.post(`/api/menu_sys/product/list`, data, function(result) {
          console.log(result);

          finish();
        });
      },
      fail: function() {

      }
    });
  });
}

function finish() {
  toastr['success']('更新菜單完成，將會幫您導回菜單管理頁面');

  var url = $('#url').val();
  setTimeout(function() {
    window.location = `${url}/menuManager/menu`;
  }, 1000);
}

/*
function productUpdate(product, current_index, final_index) {
  var id = product[current_index].id;
  var data = {};
  data._token = $('meta[name="csrf-token"]').attr('content');

  $.ajax({
    url: `/api/menu_sys/product/${id}`,
    data: data,
    method: 'put',
    success: function(result) {
      if(current_index+1 != final_index) {
        productUpdate(product, current_index+1, final_index);
      }else {
        finish();
      }
    },
    fail: function() {

    }
  });
}

function productDelete(product, current_index, final_index) {
  var id = product[current_index].id;
  var data = {};
  data._token = $('meta[name="csrf-token"]').attr('content');

  $.ajax({
    url: `/api/menu_sys/product/${id}`,
    data: data,
    method: 'delete',
    success: function(result) {
      if(current_index+1 != final_index) {
        productDelete(product, current_index+1, final_index);
      }else {
        if(updatePros.length > 0) {
          productUpdate(updatePros, 0, updatePros.length);
        }else {
          finish();
        }
      }
    },
    fail: function() {

    }
  });
}

*/

