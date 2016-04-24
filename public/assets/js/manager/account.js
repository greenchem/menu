$(function() {
  faker();
});

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

  people = [];
  for(i=0; i<15; i++) {
    people[i] = [];
    people[i]['id'] = i;
    people[i]['employee_id'] = i;
    people[i]['name'] = personName[i];
    people[i]['company'] = companyName[Math.floor(Math.random()*3)];
    people[i]['group'] = groupName[Math.floor(Math.random()*7)];

    temp = Math.floor(Math.random()*5);
    people[i]['level'] = temp;
    people[i]['levelName'] = levelName[temp];
  }
}

