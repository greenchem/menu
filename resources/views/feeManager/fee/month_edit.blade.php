<div class="feeContent manageDiv">
    <div class="row">
      <label for="editYear">年</label>
      <select class="form-control" id="editYear">
        <option disabled>年</option>
        <option value="2015">2015</option>
        <option value="2016">2016</option>
      </select>
    </div>
    <div class="row">
      <label for="editSeason">月</label>
      <select class="form-control" id="editSeason">
        <option disabled>月</option>
        @for($i=1; $i<=12; $i++)
        <option value="{{$i}}">{{$i}}</option>
        @endfor
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
    <div class="row text-center">
      <button type="button" class="btn btn-primary" id="editBtn">確認修改</button>
    </div>
</div>

