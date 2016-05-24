<div class="feeContent addRecordDiv" >
    <div class="row text-left">
      <label for="addYear">年</label>
      <select class="form-control" id="addYear">
        @for($i=2016; $i<=date('Y'); $i++)
        <option value="{{$i}}">{{$i}}</option>
        @endfor
      </select>
    </div>
    <div class="row">
      <label for="addSeason">月</label>
      <select class="form-control" id="addMonth">
        @for($i=1; $i<=12; $i++)
        <option value="{{$i}}">{{$i}}</option>
        @endfor
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
    <div class="row text-right">
        <button class="btn btn-primary" id="addModalBtn">暫存區</button>
    </div>

    <div class="row">
      <table class="table table-striped" id="addTable">
        <thead>
          <tr>
            <th>員工ID</th>
            <th>員工姓名</th>
            <th>金額</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
    </div>

    <div class="row text-center">
      <button type="button" class="btn btn-primary" id="addBtn">新增</button>
    </div>
</div>

