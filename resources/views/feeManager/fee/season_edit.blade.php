<div class="feeContent manageDiv">
    <div class="row">
      <label for="addYear">年</label>
      <select class="form-control" id="editYear">
        @for($i=2016; $i<=date('Y'); $i++)
        <option value="{{$i}}">{{$i}}</option>
        @endfor
      </select>
    </div>
    <div class="row">
      <label for="addSeason">季</label>
      <select class="form-control" id="editSeason">
        <option value="1-3">1-3月</option>
        <option value="3-6">3-6月</option>
        <option value="6-9">6-9月</option>
        <option value="9-12">9-12月</option>
      </select>
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
      <table class="table table-striped" id="editTable">
        <thead>
          <tr>
            <th>員工ID</th>
            <th>員工姓名</th>
            <th>金額</th>
            <th>#</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
    </div>
  <button type="button" class="btn btn-primary" id="editBtn">確認修改</button>
</div>

