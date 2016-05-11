$(function() {
  //faker();
  clickEvent();
  $('#feeClassBG li:first').click();

  produceAddTable();
  produceEditTable();
});

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
  var companyId;
  var name;

  for(i=0; i<3; i++) {
    name = companyName[i];
    companyId = i;
    id = i;

    text += `<tr>`;
    text += `<td>${companyId}</td>`;
    text += `<td>${name}</td>`;
    text += `<td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editCompanyModal">修改</button>`;
    text += `<button class="btn btn-danger deleteBtn" data-id="${id}">刪除</button></td>`;
    text += `</tr>`;
  }

  $('#addTable tbody').html(text);
  tableEvent();
}

function produceEditTable() {
  var text = '';
  var i;
  var j;
  var id;
  var companyId;
  var name;

  for(i=0; i<3; i++) {
   for(j=0; j<4; j++) {
    name = companyName[i];
    group=groupName[j];

    text += `<tr>`;
    text += `<td>${name}</td>`;
    text += `<td>${group}</td>`;   
    text += `<td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editGroupModal">修改</button>`;
    text += `<button class="btn btn-danger deleteBtn" data-id="${id}">刪除</button></td>`;
    text += `</tr>`;
    }
  }

  $('#editTable tbody').html(text);
  tableEvent();
}

function tableEvent() {
  $('.deleteBtn').unbind('click');
  $('.deleteBtn').click(function() {
    var index = $(this).data('index');
    people.splice(index, 1);
    finalPage = Math.floor(people.length/peoplePerPage);
    getPeople();
    return;
    var data = {};
    $.ajax({
      url: '',
      data: data,
      method: 'delete',
      success: function(result) {

      },
      fail: function() {

      }
    });
  });

  $('.editModalBtn').unbind('click');
  $('.editModalBtn').click(function() {
    var name = $(this).data('name');
    var company = $(this).data('company');
    var group = $(this).data('group');
    var employeeId = $(this).data('employee_id');
    var id = $(this).data('id');

    $('#editName').val(name);
    $('#editEmployeeId').val(employeeId);
    $('#editAccount').modal('show');
  });
}


// faker data
var people;
var companyName = [
  '生科',
  '優好',
  '良農'
];
var groupName = [
  '人事部',
  '行銷部',
  '市場部',
  '生化部'
];
   
