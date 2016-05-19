$(function() {
  clickEvent();
});

var editTarget;

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

  $('#addMenuBtn').unbind('click');
  $('#addMenuBtn').click(function() {
    var data = {};
    data._token = $('meta[name="csrf-token"]').attr('content');
    data.name = $('#menuName').val();
    data.period_id = $('#period').val();

    $.post('/api/menu_sys/menu', data, function(m_result) {
      var menu_id = m_result.menu_id;
      var copy_id = $('#copy').val();
      var i;
      console.log(m_result);

      if(copy_id != -1) {// Copy, -1 means nothing to copy
        data = {};
        data._token = $('meta[name="csrf-token"]').attr('content');
        data.menu_id = copy_id;

        $.get(`/api/menu_sys/product/`, data, function(copy_data) {
          data = {};
          data._token = $('meta[name="csrf-token"]').attr('content');
          data.menu_id = menu_id;
          data.products = [];

          for(i=0; i<copy_data.length; i++) {// insert copy data
            copy_data[i]['menu_id'] = menu_id;
            data.products.push(copy_data[i]);
          }

          $('.editModalBtn').each(function() {
            var e = {};
            e['name'] = $(this).data('name');
            e['unit'] = $(this).data('unit');
            e['inventory'] = $(this).data('inventory');
            e['price'] = $(this).data('price');
            e['description'] = $(this).data('description');
            e['menu_id'] = menu_id;

            data.products.push(e);
          });

          // JSON encode
          data.products = JSON.stringify(data.products);
          console.log('output data', data);
          $.post(`/api/menu_sys/product/list`, data, function(result) {
            console.log(result);
            toastr['success']('新增菜單完成，將會幫您導回菜單管理頁面');

            var url = $('#url').val();
            setTimeout(function() {
              window.location = `${url}/menuManager/menu`;
            }, 1000);
          });
        });
      }else {
        data = {};
        data._token = $('meta[name="csrf-token"]').attr('content');
        data.menu_id = menu_id;
        data.products = [];

        $('.editModalBtn').each(function() {
          var e = {};
          e['name'] = $(this).data('name');
          e['unit'] = $(this).data('unit');
          e['inventory'] = $(this).data('inventory');
          e['price'] = $(this).data('price');
          e['description'] = $(this).data('description');
          e['menu_id'] = menu_id;

          console.log('e', e);
          data.products.push(e);
          console.log(data.products);
        });

        // JSON encode
        data.products = JSON.stringify(data.products);
        console.log('output data', data);
        $.post(`/api/menu_sys/product/list`, data, function(result) {
          console.log(result);
          toastr['success']('新增菜單完成，將會幫您導回菜單管理頁面');

          var url = $('#url').val();
          setTimeout(function() {
            window.location = `${url}/menuManager/menu`;
          }, 1000);
        });
      }
    });
  });
}

