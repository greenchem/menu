$(function() {
  $('.menuContent').hide();
  clickEvent();
  $('#menuList li:first').click();
});

function clickEvent() {
  $('#menuList li').unbind('click');
  $('#menuList li').click(function() {
    var status = $(this).data('status');
    var data = {};
    data._token = $('meta[name="csrf-token"]').attr('content');
    data.menu_id = $(this).data('id');

    $('#currentMenuId').val(data.menu_id);
    $('#currentMenuStatus').val(status);

    $('.menuContent').hide();
    $('#menuList li').removeClass('active');
    $(this).addClass('active');

    $.get(`/api/menu_sys/product`, data, function(result) {
      console.log(result);
      produceTable(result);
      $('.menuContent').show();
    }).fail(function() {

    });
  });

  $('#editBtn').unbind('click');
  $('#editBtn').click(function() {
    var status = $('#currentMenuStatus').val();
    var id = $('#currentMenuId').val();
    var url = $('#url').val();

    if(status == 'visible') {
      toastr['warning']('此菜單已經發佈，發佈時候不能修改，請聯絡發佈管理者');
      return;
    }
    window.location = `${url}/menuManager/edit/${id}`;
  });

  $('#deleteBtn').unbind('click');
  $('#deleteBtn').click(function() {
    var status = $('#currentMenuStatus').val();
    if(status == 'visible') {
      toastr['warning']('此菜單已經發佈，發佈時候不能修改，請聯絡發佈管理者');
      return;
    }
    var id = $('#currentMenuId').val();
    var data = {};
    data._token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
      url: `/api/menu_sys/menu/${id}`,
      data: data,
      method: 'delete',
      success: function(result) {
        console.log(result);

        if(result.status == 2) {
          toastr['error']('刪除失敗，可能是此菜單已經發佈，發佈時候不能刪除，請聯絡發佈管理者');
        }else {
          toastr['success']('刪除成功');
          setTimeout(function() {
            window.location.reload();
          }, 1000);
        }
      },
      fail: function() {

      }
    });
  });
}

function produceTable(products) {
  var i;
  var text = '';

  var e;
  var id;
  var name;
  var price;
  var unit_type;
  var inventory;
  var description;

  for(i=0; i<products.length; i++) {
    e = products[i];
    id = e.id;
    name = e.name;
    price = e.price;
    unit_type = e.unit_type;
    inventory = e.inventory;
    description = e.description;

    text += `<tr>`;
    text += `<td>${name}</td>`;
    text += `<td>${unit_type}</td>`;
    text += `<td>${inventory}</td>`;
    text += `<td>${price}</td>`;
    text += `<td>${description}</td>`;
    text += `</tr>`;
  }

  $('#menuTable tbody').html(text);
}

