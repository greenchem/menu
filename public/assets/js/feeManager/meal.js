$(function() {
  // get company
  var data = {};
  data._token = $('meta[name="csrf-token"]').attr('content');
  $.get('/api/account_sys/company', data, function(company) {
    console.log('company', company);
    initSelect(company);
  }).fail(function() {

  });

  clickEvent();
  $('#feeClassBG li:first').click();
});

function initSelect(company) {
  var i;
  var text = '';
  var e;
  var id;
  var name;

  for(i=0; i<company.length; i++) {// company
    e = company[i];
    id = e.id;
    name = e.name;

    text += `<option value='${id}'>${name}</option>`;
  }

  $('#addCompany').append(text);
  $('#editCompany').append(text);
}

function changeEvent() {
  $('#addCompany').unbind('change');
  $('#addCompany').change(function() {
    var data = {};
    data._token = $('meta[name="csrf-token"]').attr('content');

    $.get('', data, function(group) {

    }).fail(function() {

    });
  });

  $('#addGroup').unbind('clicl');
  $('#addGroup').change(function() {

  });
}

function clickEvent() {
  $('#feeClassBG li').click(function(){
    $(this).parent().find('.active').removeClass('active');
    var targetClass = $(this).attr('class');
    $(this).addClass('active');
    $('#feeContentDiv .feeContent').css('display', 'none');
    $('#feeContentDiv .feeContent.' + targetClass).css('display', 'block');
  });
}

function produceAddTable() {
  var text = '';
  var i;
  var id;
  var employeeId;
  var name;

  for(i=0; i<10; i++) {
    name = personName[i];
    employeeId = i;
    id = i;

    text += `<tr>`;
    text += `<td>${employeeId}</td>`;
    text += `<td>${name}</td>`;
    text += `<td>`;
    text += `<input type="text" class="form-control addFee" placeholder="金額"`;
    text += `data-employee_id="${employeeId}" data-id="${id}"></td>`;
    text += `</tr>`;
  }

  $('#addTable tbody').html(text);
}

function produceEditTable() {
  var text = '';
  var i;
  var id;
  var employeeId;
  var name;

  for(i=0; i<10; i++) {
    name = personName[i];
    employeeId = i;
    id = i;

    text += `<tr>`;
    text += `<td>${employeeId}</td>`;
    text += `<td>${name}</td>`;
    text += `<td>`;
    text += `<input type="text" class="form-control addFee" placeholder="金額"`;
    text += `data-employee_id="${employeeId}" data-id="${id}"></td>`;
    text += `<td><button class="btn btn-danger deleteBtn" data-id="${id}">刪除</button></td>`;
    text += `</tr>`;
  }

  $('#editTable tbody').html(text);
}

