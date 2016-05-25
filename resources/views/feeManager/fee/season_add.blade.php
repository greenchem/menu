<div class="feeContent addRecordDiv">
    <div class="row readyWrapper">
      <table class="table table-striped" id="addTable">
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
      <button type="button" class="btn btn-primary" id="addBtn">確認新增</button>
    </div>



    <div class="row text-left">
      <label for="addYear">年</label>
      <select class="form-control" id="addYear">
        @for($i=2016; $i<=date('Y'); $i++)
        <option value="{{$i}}">{{$i}}</option>
        @endfor
      </select>
    </div>
    <div class="row">
      <label for="addSeason">季</label>
      <select class="form-control" id="addSeason">
        <option value="1~3">1-3月</option>
        <option value="4~6">4-6月</option>
        <option value="7~9">7-9月</option>
        <option value="10~12">10-12月</option>
      </select>
    </div>
    <div class="row">
        <label for="addCompany">公司</label>
        <select id="addCompany" class="form-control">
            @for($i=0; $i<count($companyData); $i++)
            <option value="{{$companyData[$i]['id']}}">{{$companyData[$i]['name']}}</option>
            @endfor
        </select>
    </div>
    <div class="row">
      <label for="addGroup">部門</label>
      <select id="addGroup" class="form-control"></select>
    </div>

    <br>

    <div class="row">
      <table class="table table-striped" id="addTempTable">
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
      <button type="button" class="btn btn-primary" id="addTempBtn">加到暫存區</button>
    </div>
</div>

<br>
<br>

