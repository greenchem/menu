$(function() {
  faker();
  clickEvent();
  getPeople();
});

var people;
var finalPage;
var currentPage = 0;
var peoplePerPage = 10;

function clickEvent() {
  $('#addModalBtn').unbind('click');
  $('#addModalBtn').click(function() {

  });

  $('#editBtn').unbind('click');
  $('#editBtn').click(function() {

  });

  $('#addBtn').unbind('click');
  $('#addBtn').click(function() {

  });
}

function getPeople() {
  produceTable();
  producePage();
}

function produceTable() {
  var i;
  var person;
  var employeeId;
  var id;
  var name;
  var levelName;
  var company;
  var group;
  var text = '';

  for(i=0, j=currentPage*peoplePerPage; i<peoplePerPage&&j<people.length; i++, j++) {
    person = people[j];
    id = person['id'];
    name = person['name'];
    levelName = person['levelName'];
    company = person['company'];
    group = person['group'];
    employeeId = person['employeeId'];

    text += `<tr>`;
    text += `<td>${employeeId}</td>`;
    text += `<td>${name}</td>`;
    text += `<td>${company} - ${group}</td>`;
    text += `<td>${levelName}</td>`;
    text += `<td>`;
    text += `<button class="btn btn-primary">修改</button>`;
    text += `<button class="btn btn-danger">刪除</button>`;
    text += `</td>`;
    text += `</tr>`;
  }

  $('#menuTable tbody').html(text);
  tableEvent();
}

function producePage() {
  var i;
  var minPage = Math.max(currentPage - 5, 0);
  var maxPage = Math.min(minPage + 10, finalPage);
  var text = '';

  // previous
  if(currentPage != 0) {
    text += `<li id="prevBtn"><a><span>&laquo;</span></a></li>`;
  }else {
    text += `<li class="disabled"><a><span>&laquo;</span></a></li>`;
  }
  // page number
  for(i=minPage; i<=maxPage; i++) {
    if(i==currentPage) {
      text += `<li class="pageBtn active" data-page="${i}"><a>${i+1}</a></li>`;
    }else {
      text += `<li class="pageBtn" data-page="${i}"><a>${i+1}</a></li>`;
    }
  }
  // next
  if(currentPage != finalPage) {
    text += `<li id="nextBtn"><a><span>&raquo;</span></a></li>`;
  }else {
    text += `<li class="disabled"><a><span>&raquo;</span></a></li>`;
  }

  $('.pagination').html(text);
  pageEvent();
}

function tableEvent() {
  $('.deleteBtn').unbind('click');
  $('.deleteBtn').click(function() {

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

  });
}

function pageEvent() {
  $('.pageBtn').unbind('click');
  $('.pageBtn').click(function() {
    currentPage = $(this).data('page');
    getPeople();
  });

  $('#nextBtn').unbind('click');
  $('#nextBtn').click(function() {
    currentPage++;
    getPeople();
  });

  $('#prevBtn').unbind('click');
  $('#prevBtn').click(function() {
    currentPage--;
    getPeople();
  });
}

// faker data
var companyName = [
  '生科',
  '優好',
  '良農'
];
var groupName = [
  '人事部',
  '行銷部',
  '市場部',
  '生化部',
  '主計部',
  '經濟部',
  '科技部'
];
var personName = [
  '黃國昌',
  '蔡英文',
  '馬英九',
  '陳水扁',
  '連戰',

  '連勝文',
  '柯文哲',
  '陳菊',
  '賴清德',
  '張花冠',

  '胡志強',
  '翁啟惠',
  '林昶佐',
  '羅淑蕾',
  '熊柏安'
];
var levelName = [
  '經理',
  '副理',
  '組頭',
  '組員',
  '掃地'
];


function faker() {
  var i;
  var j;
  var k;
  var temp;
  var temp1;
  var festivalSum = 0;
  var productId = 0;

  // Produce People Data
  people = [];
  for(i=0; i<15; i++) {
    people[i] = [];
    people[i]['id'] = i;
    people[i]['employeeId'] = i;
    people[i]['name'] = personName[i];
    people[i]['company'] = companyName[Math.floor(Math.random()*3)];
    people[i]['group'] = groupName[Math.floor(Math.random()*7)];

    temp = Math.floor(Math.random()*5);
    people[i]['level'] = temp;
    people[i]['levelName'] = levelName[temp];
  }

  // Produce Page
  finalPage = Math.floor(people.length/peoplePerPage);
}

