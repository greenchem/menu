$(function() {
  getMenu();
});

var editTarget;
// Product type is the following three main type :
// old
// new
// update
var updatePros = [];
var deletePros = [];
var addPros = [];

function getMenu() {
  var data = {};
  data._token = $('meta[name="csrf-token"]').attr('content');
  data.menu_id = $('#menu_id').val();

  $.get(`/api/menu_sys/product/`, data, function(products) {
    console.log(products);
    var i;
    var text = '';
    var e;
    var id;
    var name;
    var unit;
    var price;
    var inventory;
    var description;

    for(i=0; i<products.length; i++) {
      e = products[i];
      id = e.id;
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
      text += `data-id="${id}"`;
      text += `data-name="${name}"`;
      text += `data-unit="${unit}"`;
      text += `data-inventory="${inventory}"`;
      text += `data-price="${price}"`;
      text += `data-description="${description}"`;
      text += `data-type="old"`;
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
    $('#currentEditType').val('new');
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
    var type = $(this).data('type');

    // insert value
    $('#editName').val(name);
    $('#editUnit').val(unit);
    $('#editInventory').val(inventory);
    $('#editPrice').val(price);
    $('#editDescription').val(description);

    // env
    if(type == 'old' || type == 'update') {
      var id = $(this).data('id');
      $('#currentEditId').val(id);
    }
    $('#currentEditType').val(type);
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
    text += `data-type="new"`;
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
    var id;
    var name = _.trim($('#editName').val());
    var unit = _.trim($('#editUnit').val());
    var inventory = _.trim($('#editInventory').val());
    var price = _.trim($('#editPrice').val());
    var description = _.trim($('#editDescription').val());
    var type = $('#currentEditType').val();
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
    if(type == 'old') {// type control
      text += `data-type="update"`;
    }else {
      text += `data-type="${type}"`;
    }

    if(type == 'old' || type == 'update') {// id control
      id = $('#currentEditId').val();
      text += `data-id="${id}"`;
    }

    text += `>編輯</button>`;
    text += `<button class="btn btn-danger deleteBtn">刪除</button>`;
    text += `</td>`;

    editTarget.html(text);
    $('#editElement').modal('hide');
    clickEvent();
  });

  $('.deleteBtn').unbind('click');
  $('.deleteBtn').click(function() {
    var target = $(this)
      .parent()
      .find('.editModalBtn');
    var type = target.data('type');
    if(type == 'old' || type == 'update') {
      var id = target.data('id');
      deletePros.push(id);
    }

    $(this).parent().parent().remove();
  });

  $('#editMenuBtn').unbind('click');
  $('#editMenuBtn').click(function() {
    var menu_id = $('#menu_id').val();

    $('.editModalBtn').each(function() {// prepare data
      var type = $(this).data('type');
      var e = {};
      e['name'] = $(this).data('name');
      e['unit_type'] = $(this).data('unit');
      e['inventory'] = $(this).data('inventory');
      e['price'] = $(this).data('price');
      e['description'] = $(this).data('description');
      e['menu_id'] = menu_id;

      if(type == 'old') {// nothing

      }else if(type == 'new') {// add
        addPros.push(e);
      }else if(type == 'update') {// update
        e['id'] = $(this).data('id');
        updatePros.push(e);
      }
    });

    console.log('add', addPros);
    console.log('update', updatePros);
    console.log('delete', deletePros);
    productAdd();
  });
}

function finish() {
  toastr['success']('更新菜單完成，將會幫您導回菜單管理頁面');

  var url = $('#url').val();
  setTimeout(function() {
    window.location = `${url}/menuManager/menu`;
  }, 1000);
}

function productAdd() {
  if(addPros.length == 0) {
    productUpdate(updatePros, 0, updatePros.length);
    return;
  }

  var data = {};
  data.menu_id = $('#menu_id').val();
  data._token = $('meta[name="csrf-token"]').attr('content');
  data.products = JSON.stringify(addPros);

  $.post('/api/menu_sys/product/list', data, function(result) {
    console.log('add Pros finish', result);
    productUpdate(updatePros, 0, updatePros.length);
  }).fail(function() {

  });
}

function productUpdate(product, current_index, final_index) {
  if(product.length == 0) {
    productDelete(deletePros, 0, deletePros.length);
    return;
  }

  var e = product[current_index];
  var id = e.id;
  var data = {};
  data._token = $('meta[name="csrf-token"]').attr('content');
  data.name = e.name;
  data.price = e.price;
  data.unit_type = e.unit_type;
  data.inventory = e.inventory;
  data.description = e.description;

  $.ajax({
    url: `/api/menu_sys/product/single/${id}`,
    data: data,
    method: 'put',
    success: function(result) {
      if(current_index+1 != final_index) {
        productUpdate(product, current_index+1, final_index);
      }else {
        productDelete(deletePros, 0, deletePros.length);
      }
    },
    fail: function() {

    }
  });
}

function productDelete(product, current_index, final_index) {
  if(product.length == 0) {
    finish();
    return;
  }

  var id = product[current_index];
  var data = {};
  data._token = $('meta[name="csrf-token"]').attr('content');

  $.ajax({
    url: `/api/menu_sys/product/single/${id}`,
    data: data,
    method: 'delete',
    success: function(result) {
      if(current_index+1 != final_index) {
        productDelete(product, current_index+1, final_index);
      }else {
        finish();
      }
    },
    fail: function() {

    }
  });
}

