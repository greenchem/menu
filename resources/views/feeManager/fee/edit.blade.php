<div class="feeContent manageDiv">
    <div class="row readyWrapper">
      <table class="table table-striped" id="editTable">
        <thead>
          <tr>
            <th>員工ID</th>
            <th>員工姓名</th>
            <th>職等</th>
            <th>金額</th>
            <th>#</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
    </div>
    <div class="row text-center">
      <button type="button" class="btn btn-primary" id="editBtn">確認修改</button>
    </div>
    <div class="row">
      <label for="editTimestamp">紀錄</label>
      <select class="form-control" id="editTimestamp"></select>
    </div>
    <div class="row">
      <label for="editCompany">公司</label>
      <select id="editCompany" class="form-control">
            @for($i=0; $i<count($companyData); $i++)
            <option value="{{$companyData[$i]['id']}}">{{$companyData[$i]['name']}}</option>
            @endfor
      </select>
    </div>

    <div class="row">
      <label for="editGroup">部門</label>
      <select id="editGroup" class="form-control"></select>
    </div>

    <div class="row">
      <table class="table table-striped" id="editTempTable">
        <thead>
          <tr>
            <th>員工ID</th>
            <th>員工姓名</th>
            <th>職等</th>
            <th>金額</th>
            <th>#</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
    </div>
    <div class="row text-center">
      <button type="button" class="btn btn-primary" id="editTempBtn">加到暫存區</button>
    </div>
</div>

<br>
<br>

